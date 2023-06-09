function uncheckOthers(checkbox) {
    const checkboxes = document.querySelectorAll('input[name="category"]');
    const currentName = checkbox.getAttribute('data-name');

    checkboxes.forEach((cb) => {
        const name = cb.getAttribute('data-name');
        if (name !== currentName) {
            cb.checked = false;
        }
    });
}

function sendSearchInput() {
    const searchInput = document.getElementById('searchInput').value;
    calculatePrices();
    document.getElementById('searchInputFilter').value = searchInput;
    document.getElementById('filterForm').submit();
}

function sendFilterInputs() {
    const minPrice = document.getElementById('minPrice').value;
    const maxPrice = document.getElementById('maxPrice').value;
    calculatePrices();

    const checkboxes = document.querySelectorAll('input[name="size"]:checked');

    document.getElementById('minPriceSearch').value = minPrice;
    document.getElementById('maxPriceSearch').value = maxPrice;

    checkboxes.forEach((checkbox) => {
        const size = checkbox.value;
        document.getElementById(`sizeSearch_${size}`).checked = true;
    });
}

document.getElementById('minPrice').onkeypress = function (event) {
    return validateNumericInput(event);
};

document.getElementById('maxPrice').onkeypress = function (event) {
    return validateNumericInput(event);
};

function validateNumericInput(event) {
    const charCode = event.which ? event.which : event.keyCode;
    if (charCode < 48 || charCode > 57) {
        event.preventDefault();
        return false;
    }
    return true;
}

function calculatePrices() {
    const minPriceInput = document.getElementById('minPrice');
    const maxPriceInput = document.getElementById('maxPrice');

    let minPrice = minPriceInput.value;
    let maxPrice = maxPriceInput.value;

    if (minPrice === '' && maxPrice === '') {
        return;
    }

    if (minPrice === '') {
        minPrice = 0;
    }

    if (maxPrice === '') {
        maxPrice = parseInt(minPrice) + 500;
    }

    minPriceInput.value = minPrice;
    maxPriceInput.value = maxPrice;
}