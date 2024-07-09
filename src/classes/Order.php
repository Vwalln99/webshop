<?php

class Order
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function placeOrder($user_id, $address_line1, $address_line2, $city, $state, $zip_code, $country, $payment_type, $account_number, $expiry_date)
    {
        try {
            $this->db->beginTransaction();

            $sql_address = "INSERT INTO addresses (user_id, address_line1, address_line2, city, state, zip_code, country) 
                            VALUES (:user_id, :address_line1, :address_line2, :city, :state, :zip_code, :country)";
            $stmt_address = $this->db->prepare($sql_address);
            $stmt_address->execute([
                ':user_id' => $user_id,
                ':address_line1' => $address_line1,
                ':address_line2' => $address_line2,
                ':city' => $city,
                ':state' => $state,
                ':zip_code' => $zip_code,
                ':country' => $country
            ]);
            $address_id = $this->db->lastInsertId();

            $sql_payment = "INSERT INTO payment_methods (user_id, type, provider, account_number, expiry_date) 
                            VALUES (:user_id, :type, :provider, :account_number, :expiry_date)";
            $stmt_payment = $this->db->prepare($sql_payment);
            $stmt_payment->execute([
                ':user_id' => $user_id,
                ':type' => $payment_type,
                ':provider' => '',
                ':account_number' => $account_number,
                ':expiry_date' => $expiry_date
            ]);
            $payment_id = $this->db->lastInsertId();

            $sql_order = "INSERT INTO orders (user_id, address_id, payment_method_id, created_at) 
                          VALUES (:user_id, :address_id, :payment_id, NOW())";
            $stmt_order = $this->db->prepare($sql_order);
            $stmt_order->execute([
                ':user_id' => $user_id,
                ':address_id' => $address_id,
                ':payment_id' => $payment_id
            ]);
            $order_id = $this->db->lastInsertId();

            $this->db->commit();

            return $order_id;
        } catch (PDOException $e) {
            echo "Fehler beim Speichern der Bestellung: " . $e->getMessage();
            $this->db->rollBack();
            return false;
        }
    }
}
