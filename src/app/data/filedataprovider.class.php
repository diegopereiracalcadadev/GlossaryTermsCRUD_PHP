<?php

class FileDataProvider extends DataProvider
{
    public function get_terms()
    {
        $json = $this->get_data();
        return json_decode($json);
    }

    public function get_term($id)
    {
        $terms = $this->get_terms();

        foreach ($terms as $item) {
            if ($item->term == $id) {
                return $item;
            }
        }

        return false;
    }

    private function get_data()
    {
        $json = '';

        if (!file_exists($this->source)) {
            file_put_contents($this->source, '');
        } else {
            $json = file_get_contents($this->source);
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

        $result = array_filter($terms, function ($item) use ($search) {
            if (
                str_contains($item->term, $search)
                || str_contains($item->definition, $search)
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

    public function update_term($id, $new_term, $definition)
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
