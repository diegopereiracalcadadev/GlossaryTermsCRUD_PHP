<?php

class FileDataProvider
{
    function __construct($file_path)
    {
        $this->file_path = $file_path;
    }

    public function get_terms()
    {
        $json = $this->get_data();
        return json_decode($json);
    }

    public function get_term($term)
    {
        $terms = $this->get_terms();

        foreach ($terms as $item) {
            if ($item->term == $term) {
                return $item;
            }
        }

        return false;
    }

    private function get_data()
    {
        $fileName = CONFIG['data_file'];

        $json = '';

        if (!file_exists($fileName)) {
            file_put_contents($fileName, '');
        } else {
            $json = file_get_contents($fileName);
        }

        return $json;
    }

    private function set_data($arr)
    {
        $filePath = CONFIG['data_file'];

        $json = json_encode($arr);

        file_put_contents($filePath, $json);
    }

    public function search_terms($search)
    {
        $terms = $this->get_terms();

        $result = array_filter($terms, public function ($item) use ($search) {
            if (
                strpos($item->term, $search) !== false
                || strpos($item->definition, $search) !== false
            ) {
                return $item;
            }
        });

        return $result;
    }

    public function add_term($term, $definition)
    {
        $terms = $this->get_terms();

        $terms[] = new GlossaryTerm($term, $definition);
        $this->set_data($terms);
    }

    public function update_term($original_term, $new_term, $definition)
    {
        $terms = $this->get_terms();

        foreach ($terms as $item) {
            if ($item->term == $original_term) {
                $item->term = $new_term;
                $item->definition = $definition;
                break;
            }
        }

        $this->set_data($terms);
    }

    public function delete_term($term)
    {
        $terms = $this->get_terms();

        for ($i = 0; $i < count($terms); $i++) {
            if ($terms[$i]->term === $term) {
                unset($terms[$i]);
                break;
            }
        }

        $newTerms = array_values($terms);
        $this->set_data($newTerms);
    }
}
