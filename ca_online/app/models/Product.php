<?php

// namespace App\Models;

class Product
{

    private $db;

    public function __construct()
    {
        require_once 'Database.php';
        require_once 'Image.php';
        require_once 'Transaction.php';

        // Instancier la classe Database
        $dbase = new Database();
        $this->db = $dbase->getConnection();

        // Vérifier la connexion à la base de données
        if ($this->db === null) {
            die("Database connection failed.");
        }
    }



    /**
     * Create product
     */
    public function insert($data)
    {
        $response = [
            'status' => null,
            'message' => null,
        ];

        $product_code = htmlspecialchars($data['product_code']);
        $product_name = htmlspecialchars($data['product_name']);
        $category_id = intval($data['category_id']);
        $product_price = intval($data['product_price']);
        $product_quantity = intval($data['product_quantity']);
        $product_image = $data['product_image'];
        $imageName = '';
        $destination = htmlspecialchars($data['destination']);
        $now = date('Y-m-d H:i:s');

        // Vérifier si le produit existe déjà
        if (!$this->checkProductExistence($product_name, $product_code)) {

            // Enregistrer l'image s'il y en a
            if ($product_image["error"] == 0) {
                $imageModel = new Image();
                $imageResponse = $imageModel->uploadImage($product_image, $destination);
                if ($imageResponse['status'] != 'success') {
                    $response['status'] = $imageResponse['status'];
                    $response['message'] = $imageResponse['message'];
                    return $response;
                }
                $imageName = $imageResponse['image'];
            }

            $sql = "INSERT INTO products (product_code, product_name, category_id, product_price, product_quantity, product_image) VALUES (?,?,?,?,?,?)";
            $req = $this->db->prepare($sql);
            $result = $req->execute([$product_code, $product_name, $category_id, $product_price, $product_quantity, $imageName ?? null]);
            if ($result) {
                $response['status'] = 'success';
                $response['message'] = 'Produit enregistré avec succès';
            } else {
                $response['status'] = 'error';
                $response['message'] = 'Une erreur inattendue est survenue lors de l\'enregistrement du produit';
            }
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Ce produit existe déjà !';
        }
        return $response;
    }





    /**
     * Create product
     */
    public function importData($data)
    {

        extract($data);

        $name = $code_barre . ' - ' . $type . ' - ' . $marque . ' - ' . $taille . ' - ' . $couleur;

        $sql = "INSERT INTO products (product_code, product_name, category_id, product_price, product_quantity, product_image, product_size, product_color, product_type, product_brand) VALUES (?,?,?,?,?,?,?,?,?,?)";
        $req = $this->db->prepare($sql);
        $result = $req->execute([$code_barre, $name, $categorie, $prix, $quantite, $image ?? null, $taille, $couleur, $type, $marque]);

        return $result;
    }





    /**
     * Verify if product user already exists
     */
    public function checkProductExistence($product_name, $product_code)
    {
        $sql = "SELECT * FROM products WHERE (product_name = ? OR product_code = ?) AND product_status=?";
        $req = $this->db->prepare($sql);
        $result = $req->execute([$product_name, $product_code, 1]);
        return $req->fetch();
    }



    /**
     * Update product
     */

    public function update($data)
    {
        $product_id = htmlspecialchars($data['product_id']);
        $product_code = htmlspecialchars($data['product_code']);
        $product_name = htmlspecialchars($data['product_name']);
        $category_id = intval($data['category_id']);
        $product_price = intval($data['product_price']);
        $product_quantity = intval($data['product_quantity']);
        $product_image = $data['product_image'];
        $imageName = '';
        $destination = htmlspecialchars($data['destination']);

        // Enregistrer l'image s'il y en a
        if ($product_image["error"] == 0) {
            $imageModel = new Image();
            $imageResponse = $imageModel->uploadImage($product_image, $destination);
            if ($imageResponse['status'] != 'success') {
                $response['status'] = $imageResponse['status'];
                $response['message'] = $imageResponse['message'];
                return $response;
            }
            $imageName = $imageResponse['image'];
        }

        $sql = "UPDATE products SET product_code=?, product_name=?, category_id=?, product_price=?, product_quantity=?";
        $params = [$product_code, $product_name, $category_id, $product_price, $product_quantity];
        if ($imageName) {
            $sql .= ', product_image=?';
            $params[] = $imageName;
        }
        $sql .= ' WHERE id_product=?';
        $params[] = $product_id;

        $req = $this->db->prepare($sql);
        $result = $req->execute($params);

        return $result;
    }


    public function reduceProductQuantity($product_id, $quantity)
    {
        $sql = "UPDATE products SET product_quantity = product_quantity - ? WHERE id_product = ?";
        $req = $this->db->prepare($sql);
        $result = $req->execute([$quantity, $product_id]);
        return $result;
    }



    /**
     * Verify if stock already exists
     */
    public function checkStockExistence($shop_id, $product_id)
    {
        $sql = "SELECT * FROM stocks WHERE (shop_id=? AND product_id=?)";
        $req = $this->db->prepare($sql);
        $req->execute([$shop_id, $product_id]);
        $result = $req->fetch();
        return $result;
    }


    /**
     * Méthode to select categories
     */
    public function getAll()
    {
        $sql = "SELECT * FROM products
        INNER JOIN categories ON products.category_id = categories.id_category
        WHERE product_status=?";
        $req = $this->db->prepare($sql);
        $req->execute([1]);
        return $req->fetchAll();
    }
    public function getAllOnly()
    {
        $sql = "SELECT * FROM products WHERE product_status=?";
        $req = $this->db->prepare($sql);
        $req->execute([1]);
        return $req->fetchAll();
    }

    public function get($id)
    {
        $sql = "SELECT * FROM products WHERE id_product = ?";
        $req = $this->db->prepare($sql);
        $req->execute([$id]);
        return $req->fetch();
    }

    public function getProductByCode($code)
    {
        $sql = "SELECT * FROM products AS p
        INNER JOIN categories c ON p.category_id = c.id_category
        -- LEFT JOIN stocks s ON s.product_id = p.id_product
        WHERE product_code = ?";
        $req = $this->db->prepare($sql);
        $req->execute([$code]);
        return $req->fetch();
    }

    public function getWhithStock($code)
    {
        $sql = "SELECT * FROM products INNER JOIN stocks ON id_product=product_id WHERE product_code = ?";
        $req = $this->db->prepare($sql);
        $req->execute([$code]);
        return $req->fetch();
    }


    public function delete($id)
    {
        $sql = "DELETE FROM products WHERE id_product = ?";
        $req = $this->db->prepare($sql);
        $result = $req->execute([$id]);
        return $result;
    }

    /**
     * Get products of the category id
     * @param @id 
     */
    public function getCategoryProducts($id)
    {
        $sql = "SELECT * FROM products INNER JOIN categories ON id_category = products.category_id
        WHERE products.category_id = ? AND product_status = ?";
        $req = $this->db->prepare($sql);
        $req->execute([$id, 1]);
        return $req->fetchAll();
    }









    /**
     * Gestion des stocks
     */
    public function addOrUpdateStock($shop_id, $product_id, $quantity)
    {
        try {
            // Préparation de la requête SQL
            $check = $this->checkStockExistence($shop_id, $product_id);
            $sql = $check ?
                "UPDATE stocks SET stock_quantity = stock_quantity + :quantity WHERE shop_id = :shop_id AND product_id = :product_id" :
                "INSERT INTO stocks (stock_quantity, shop_id, product_id) VALUES (:quantity, :shop_id, :product_id)";

            // Préparation de la déclaration
            $req = $this->db->prepare($sql);

            // Liaison des paramètres à la déclaration
            $req->bindParam(':quantity', $quantity, PDO::PARAM_INT);
            $req->bindParam(':shop_id', $shop_id, PDO::PARAM_INT);
            $req->bindParam(':product_id', $product_id, PDO::PARAM_INT);

            // Exécution de la requête
            $req->execute();

            // Ajouter la transaction
            // `transaction_type`, product_id, transaction_quantity, shop_owner, shop_from, shop_to
            $transacData = [
                'transaction_type' => 'approvisionnement',
                'product_id' => $product_id,
                'transaction_quantity' => $quantity,
                'shop_owner' => '',
                'shop_from' => '',
                'shop_to' => $shop_id,
            ];
            $transactionModel = new Transaction();
            $transactionModel->insert($transacData);

            return true; // Succès
        } catch (PDOException $e) {
            // Gestion des erreurs
            error_log("Erreur lors de l'exécution de la requête SQL : " . $e->getMessage());
            return false; // Échec
        }
    }

    /**
     * Update stock quantities
     */

    public function updateStockQuantity($product_id, $stock_quantity, $shop_id)
    {
        $sql = "UPDATE stocks SET stock_quantity=stock_quantity+?, shop_id=?, product_id=? WHERE shop_id=? AND product_id=?";
        $req = $this->db->prepare($sql);
        $result = $req->execute([$stock_quantity, $shop_id, $product_id, $shop_id, $product_id]);
        return $result;
    }



    /**
     * Méthode pour sélectionner les produits de la boutique
     */
    public function getProducts($text)
    {
        $sql = "SELECT * FROM products AS p
            WHERE (p.product_name LIKE ? OR p.product_code LIKE ? OR p.product_brand LIKE ? OR p.product_type LIKE ?) AND p.product_status = ?";
        $req = $this->db->prepare($sql);
        $req->execute(["%$text", "%$text", "%$text", "%$text", 1]);
        return $req->fetchAll();
    }

    /**
     * Méthode pour sélectionner les produits de la boutique
     */
    public function getShopProducts($id)
    {
        $sql = "SELECT * FROM products AS p
            LEFT JOIN stocks s ON p.id_product = s.product_id
            WHERE p.product_status = ? AND s.shop_id = ?";
        $req = $this->db->prepare($sql);
        $req->execute([1, $id]);
        return $req->fetchAll();
    }

    /**
     * Méthode pour rechercher des produits de la boutique par nom ou par code
     */
    public function getSearchShopProducts($shop_id, $searchText)
    {
        $sql = "SELECT * FROM products AS p
            LEFT JOIN stocks s ON p.id_product = s.product_id
            WHERE (p.product_name LIKE ? OR p.product_code LIKE ?) AND p.product_status = ? AND s.shop_id = ?";
        $req = $this->db->prepare($sql);
        $req->execute(["%$searchText%", "%$searchText%", 1, $shop_id]);
        return $req->fetchAll();
    }

    /**
     * Méthode pour rechercher des produits de la boutique par nom ou par code
     */
    public function getShopCategoryProducts($shop_id, $categoryId)
    {
        $sql = "SELECT * FROM products AS p
            LEFT JOIN stocks s ON p.id_product = s.product_id
            WHERE (p.category_id = ?) AND p.product_status = ? AND s.shop_id = ?";
        $req = $this->db->prepare($sql);
        $req->execute([$categoryId, 1, $shop_id]);
        return $req->fetchAll();
    }


    /**
     * Méthode pour sélectionner les clients ayant achetés
     */
    public function getProductClients($productId)
    {
        $shop_id = $_SESSION['user']['shop_id'];
        $sql = "SELECT *, SUM(sl.sales_line_quantity) AS qty, SUM(sales_line_price - sales_line_discount) AS total FROM sale_lines AS sl
            INNER JOIN sales s ON sl.sale_facture_code = s.sale_facture_code
            INNER JOIN customers c ON s.customer_code = c.customer_code
            WHERE sl.product_id = ? AND s.sale_shop = ? GROUP BY s.customer_code ORDER BY qty DESC";
        $req = $this->db->prepare($sql);
        $req->execute([$productId, $shop_id]);
        return $req->fetchAll();
    }




    // FIN
}
