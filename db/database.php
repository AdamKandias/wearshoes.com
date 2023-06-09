<?php

class Database
{
    private string $host = "localhost";
    private string $username = "root";
    private string $password = "";
    private string $dbName = "wearshoes";
    private $connection;

    public function __construct()
    {
        try {
            $this->connection = new PDO("mysql:host=$this->host;dbname=$this->dbName", $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        } catch (PDOException $error) {
            echo "Failed to connect to MySQL: " . $error->getMessage();
            exit();
        }
    }

    public function __destruct()
    {
        $this->connection = null;
    }

    public function fetchNewestProducts()
    {
        try {
            $stmt = $this->connection->prepare("SELECT products.name, products.price, products.slug, images.image as image FROM products JOIN images ON products.id=images.product_id GROUP BY products.id ORDER BY products.created_at DESC LIMIT 4");
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $error) {
            echo "Error on fetch all products: " . $error->getMessage();
        }
    }

    public function fetchAllProductsWithoutImages()
    {
        try {
            $stmt = $this->connection->prepare("SELECT products.name, products.price, products.color, products.size, products.weight, products.quantity, categories.category FROM products JOIN categories ON products.category_id=categories.id ORDER BY products.created_at DESC");
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $error) {
            echo "Error on fetch all products: " . $error->getMessage();
        }
    }

    public function insert(array $data): bool
    {
        try {
            $stmt = $this->connection->prepare("INSERT INTO products (id, name, slug, description, price, color, size, weight, quantity, category_id)
            VALUES (:id, :name, :slug, :description, :price, :color, :size, :weight, :quantity, :category_id)");
            return $stmt->execute($data);
        } catch (PDOException $error) {
            echo "Error on insert data: " . $error->getMessage();
        }
    }

    public function edit(array $data)
    {
        try {
            $sql = "";
            if (isset($data["slug"])) {
                $sql = "UPDATE products SET name=?, slug=?, description=?, price=?, color=?, size=?, weight=?, quantity=?, category_id=? WHERE id=?";
            } else {
                $sql = "UPDATE products SET description=?, price=?, color=?, size=?, weight=?, quantity=?, category_id=? WHERE id=?";
            }

            $stmt = $this->connection->prepare($sql);

            $stmt->execute($data);
        } catch (PDOException $error) {
            echo "Error on edit data: " . $error->getMessage();
        }
    }

    public function destroy(string $id)
    {
        try {
            $stmt = $this->connection->prepare("DELETE FROM products WHERE id=:id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();
        } catch (PDOException $error) {
            echo "Error on delete data: " . $error->getMessage();
        }
    }

    public function insertImages(array $files, string $product_id): bool
    {
        try {
            $stmt = $this->connection->prepare("INSERT INTO images (image, product_id)
            VALUES (:image, :product_id)");
            foreach ($files as $file) {
                $image_name = $file['name'] . "." . $file["type"];
                $stmt->bindParam(":image", $image_name, PDO::PARAM_STR);
                $stmt->bindParam(":product_id", $product_id);
                $stmt->execute();
            }
            return true;
        } catch (PDOException $error) {
            echo "Error on insert image: " . $error->getMessage();
        }
    }

    public function insertImage(string $name, string $product_id): bool
    {
        try {
            $stmt = $this->connection->prepare("INSERT INTO images (image, product_id)
            VALUES (:image, :product_id)");
            $stmt->bindParam(":image", $name, PDO::PARAM_STR);
            $stmt->bindParam(":product_id", $product_id);
            return $stmt->execute();
        } catch (PDOException $error) {
            echo "Error on insert image: " . $error->getMessage();
        }
    }

    public function getSingleRandomProduct()
    {
        try {
            $stmt = $this->connection->prepare("SELECT products.slug, images.image as image FROM products JOIN images ON products.id=images.product_id ORDER BY RAND() LIMIT 1");
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $error) {
            echo "Error on fetch all products: " . $error->getMessage();
        }
    }

    public function getRelatedProducts($productCategory, $currentProductId)
    {
        try {
            $stmt = $this->connection->prepare("SELECT products.name, products.price, products.slug, images.image as image FROM products JOIN images ON products.id=images.product_id WHERE products.category_id=:productCategory AND products.id!=:currentProductId GROUP BY products.id ORDER BY RAND() LIMIT 4");
            $stmt->bindParam(":productCategory", $productCategory);
            $stmt->bindParam(":currentProductId", $currentProductId);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $error) {
            echo "Error on fetch all products: " . $error->getMessage();
        }
    }

    public function getProductBySlug(string $slug)
    {
        try {
            $stmt = $this->connection->prepare("SELECT products.*, categories.category as category FROM products JOIN categories ON products.category_id=categories.id WHERE products.slug=:slug LIMIT 1");
            $stmt->bindParam(":slug", $slug);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $error) {
            echo "Error on fetch all products: " . $error->getMessage();
        }
    }

    public function getImagesByProductId(string $product_id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM images WHERE images.product_id=:product_id");
            $stmt->bindParam(":product_id", $product_id);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $error) {
            echo "Error on fetch all products: " . $error->getMessage();
        }
    }

    public function getAllProductRandomOrder()
    {
        try {
            $stmt = $this->connection->prepare("SELECT products.name, products.price, products.slug, images.image as image FROM products JOIN images ON products.id=images.product_id GROUP BY products.id ORDER BY RAND()");
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $error) {
            echo "Error on fetch all products: " . $error->getMessage();
        }
    }

    public function searchProduct($keyword, $category)
    {
        $conditions = [];
        $orderBy = "RAND()";

        if (!empty($keyword)) {
            $keywords = explode('-', str_replace('+', ' ', $keyword));

            foreach ($keywords as $key) {
                $conditions[] = "products.name LIKE '%" . trim($key) . "%'";
            }

            $orderBy = "CASE WHEN " . implode(" AND ", $conditions) . " THEN 1 ELSE 2 END, RAND()";
        }

        if (!empty($category)) {
            $categoryId = $this->getCategoryIdByName($category);
            if ($categoryId) {
                $conditions[] = "products.category_id = " . $categoryId;
            }
        }

        try {
            $query = "SELECT products.name, products.price, products.slug, images.image as image FROM products JOIN images ON products.id=images.product_id";

            if (!empty($conditions)) {
                $query .= " WHERE " . implode(' AND ', $conditions);
            }

            $query .= " GROUP BY products.id ORDER BY " . $orderBy;

            $stmt = $this->connection->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $error) {
            echo "Error on fetch all products: " . $error->getMessage();
        }
    }

    public function getImagesById(string $id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM images WHERE images.id=:id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $error) {
            echo "Error on fetch all products: " . $error->getMessage();
        }
    }

    public function fetchAllCategories(): array
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM categories");
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $error) {
            echo "Error on fetch all categories: " . $error->getMessage();
        }
    }

    public function getCategoryIdByName(string $categoryName)
    {
        try {
            $stmt = $this->connection->prepare("SELECT id FROM categories WHERE category = ?");
            $stmt->execute([$categoryName]);
            $categoryId = $stmt->fetchColumn();
            return $categoryId;
        } catch (PDOException $error) {
            echo "Error on get category ID: " . $error->getMessage();
            return null;
        }
    }

    public function fetchAllProducts()
    {
        try {
            $stmt = $this->connection->prepare("SELECT products.id, products.name, products.slug, categories.category, products.quantity, images.image as image FROM products JOIN images ON products.id=images.product_id JOIN categories ON products.category_id=categories.id GROUP BY products.id ORDER BY products.created_at DESC");
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $error) {
            echo "Error on fetch all products: " . $error->getMessage();
        }
    }

    public function insertContactUs(array $data)
    {
        try {
            $stmt = $this->connection->prepare("INSERT INTO contact_us (email, subject, message) VALUES (:email, :subject, :message)");
            return $stmt->execute($data);
        } catch (PDOException $error) {
            echo "Error on insert contact us data: " . $error->getMessage();
        }
    }

    public function fetchAllContactUs()
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM contact_us ORDER BY created_at DESC");
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $error) {
            echo "Error on fetch all contact us: " . $error->getMessage();
        }
    }

    public function getContactUsById(int $id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM contact_us WHERE id=:id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $message = $stmt->fetch();
            if ($message->status == "UNREAD") {
                $this->updateContactUsStatusById($id);
            }
            return $message;
        } catch (PDOException $error) {
            echo "Error on fetch all products: " . $error->getMessage();
        }
    }

    public function updateContactUsStatusById(int $id)
    {
        try {
            $stmt = $this->connection->prepare("UPDATE contact_us SET status=:status WHERE id=:id");
            $stmt->bindValue(":status", "READ");
            $stmt->bindParam(":id", $id);
            $stmt->execute();
        } catch (PDOException $error) {
            echo "Error on edit contact us status: " . $error->getMessage();
        }
    }

    public function destroyContactUsById(int $id)
    {
        try {
            $stmt = $this->connection->prepare("DELETE FROM contact_us WHERE id=:id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $error) {
            echo "Error on delete contact us: " . $error->getMessage();
        }
    }

    public function getProductsWithFilter($category, $search, $minPrice, $maxPrice, $sizes)
    {
        try {
            $query = "SELECT products.name, products.price, products.slug, images.image as image 
                  FROM products 
                  JOIN images ON products.id=images.product_id";

            $conditions = [];
            $params = [];

            if (!empty($category)) {
                if ($category == 'sport') {
                    $category = 1;
                } else if ($category == 'classic') {
                    $category = 2;
                } else if ($category == 'casual') {
                    $category = 3;
                }
                $conditions[] = "products.category_id = :category";
                $params['category'] = $category;
            }

            if (!empty($search)) {
                $conditions[] = "products.name LIKE :search";
                $params['search'] = '%' . $search . '%';
            }

            if ($minPrice != '' && $maxPrice != '') {
                $conditions[] = "products.price BETWEEN :minPrice AND :maxPrice";
                $params['minPrice'] = $minPrice .= '00';
                $params['maxPrice'] = $maxPrice .= '00';
            }

            if (!empty($sizes)) {
                $sizeConditions = [];

                foreach ($sizes as $key => $sizeValue) {
                    $sizeConditions[] = "FIND_IN_SET(:size_$key, products.size)";
                    $params["size_$key"] = $sizeValue;
                }

                $conditions[] = "(" . implode(" OR ", $sizeConditions) . ")";
            }

            if (!empty($conditions)) {
                $query .= " WHERE " . implode(" AND ", $conditions);
            }

            $query .= " GROUP BY products.id ORDER BY created_at DESC";

            $stmt = $this->connection->prepare($query);
            $stmt->execute($params);

            return $stmt->fetchAll();
        } catch (PDOException $error) {
            echo "Error on products by filter: " . $error->getMessage();
        }
    }

    public function destroyImagesByProductId(string $product_id)
    {
        try {
            $stmt = $this->connection->prepare("DELETE FROM images WHERE product_id=:product_id");
            $stmt->bindParam(":product_id", $product_id);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $error) {
            echo "Error on delete images: " . $error->getMessage();
        }
    }

    public function destroyImagesById(string $id)
    {
        try {
            $stmt = $this->connection->prepare("DELETE FROM images WHERE id=:id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $error) {
            echo "Error on fetch all products: " . $error->getMessage();
        }
    }

    public function login(string $username)
    {
        try {
            $stmt = $this->connection->prepare("SELECT admin.username, admin.password FROM admin WHERE username=:username LIMIT 1");
            $stmt->bindParam(":username", $username);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $error) {
            echo "Error on get admin data: " . $error->getMessage();
        }
    }

    public function checkAndGenerateSlug(string $slug): string
    {
        try {
            $stmt = $this->connection->prepare("SELECT slug FROM products WHERE slug LIKE '$slug%'");
            if ($stmt->execute()) {
                $total_row = $stmt->rowCount();
                if ($total_row > 0) {
                    $result = $stmt->fetchAll();
                    foreach ($result as $row) {
                        $data[] = $row->slug;
                    }

                    if (in_array($slug, $data)) {
                        $count = 0;
                        while (in_array(($slug . '-' . ++$count), $data));
                        $slug = $slug . '-' . $count;
                    }
                }
            }
            return $slug;
        } catch (PDOException $error) {
            echo "Error on fetch slug: " . $error->getMessage();
        }
    }
}
