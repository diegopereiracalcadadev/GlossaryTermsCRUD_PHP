<?php

class MySqlDataProvider extends DataProvider
{
    public function get_terms()
    {
        return $this->query("SELECT * FROM terms", []);
    }

    public function get_term($id)
    {
        $db = $this->connect();

        if ($db == null) {
            return;
        }

        $smt = $db->prepare("SELECT * FROM terms WHERE id = :id");
        $smt->execute([
            ':id' => $id
        ]);

        $result = $smt->fetchAll(PDO::FETCH_CLASS, 'GlossaryTerm');

        if (empty($result)) {
            return;
        }

        $smt = null;
        $db = null;

        return $result[0];
    }

    public function search_terms($search)
    {
        return $this->query("SELECT * FROM terms WHERE term LIKE :search OR definition LIKE :search", [':search' => '%' . $search . '%']);
    }

    public function add_term($term, $definition)
    {
        $db = $this->connect();
        // echo $db;


        if ($db == null) {
            return;
        }

        $sql = 'INSERT INTO terms (term, definition) VALUES (:term, :definition)';
        $smt = $db->prepare($sql);

        $smt->execute([
            ':term' => $term,
            ':definition' => $definition
        ]);

        $smt = null;
        $db = null;
    }

    public function update_term($id, $new_term, $definition)
    {
        $this->query(
            'UPDATE terms SET term = :term, definition = :definition WHERE id = :id',
            [
                ':id' => $id,
                ':term' => $new_term,
                ':definition' => $definition,
            ]
        );
    }

    public function delete_term($term)
    {
        $this->query(
            'DELETE FROM terms WHERE id = :id',
            [
                ':id' => $term
            ]
        );
    }

    private function connect()
    {
        try {
            return new PDO($this->source, CONFIG['db_user'], CONFIG['db_password']);
        } catch (PDOException $e) {
            var_dump($e);
            return null;
        }
    }

    private function query($sql, $sql_params)
    {
        $db = $this->connect();

        if ($db == null) {
            return [];
        }

        if (empty($sql_params)) {
            $query = $db->query($sql);
        } else {
            $query = $db->prepare($sql);
            $query->execute($sql_params);
        }

        $data = $query->fetchAll(PDO::FETCH_CLASS, "GlossaryTerm");

        $query = null;
        $db = null;

        return $data;
    }
}
