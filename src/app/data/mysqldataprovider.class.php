<?php

class MySqlDataProvider extends DataProvider
{
    public function get_terms()
    {
        $db = $this->connect();

        if ($db == null) {
            return [];
        }

        $query = $db->query("SELECT * FROM terms");
        $data = $query->fetchAll(PDO::FETCH_CLASS, "GlossaryTerm");

        // $result = $smt->execute();

        // var_dump($result);

        $query = null;
        $db = null;

        return $data;
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
        $db = $this->connect();

        $sql = 'UPDATE terms SET term = :term, definition = :definition WHERE id = :id';

        $smt = $db->prepare($sql);
        $smt->execute([
            ':id' => $id,
            ':term' => $new_term,
            ':definition' => $definition,
        ]);

        $smt = null;
        $db = null;
    }

    public function delete_term($term)
    {
        $db = $this->connect();

        $sql = 'DELETE FROM terms WHERE id = :id';
        $smt = $db->prepare($sql);
        $smt->execute([
            ':id' => $term
        ]);

        $smt = null;
        $db = null;
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
}
