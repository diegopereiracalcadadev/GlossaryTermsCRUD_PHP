<?php

function get_terms()
{
    $json = get_data();
    return json_decode($json);
}

function get_term($term)
{
    $terms = get_terms();

    foreach ($terms as $item) {
        if ($item->term == $term) {
            return $item;
        }
    }

    return false;
}

function get_data()
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

function set_data($arr)
{
    $filePath = CONFIG['data_file'];

    $json = json_encode($arr);

    file_put_contents($filePath, $json);
}

function search_terms($search)
{
    $terms = get_terms();

    $result = array_filter($terms, function ($item) use ($search) {
        if (
            strpos($item->term, $search) !== false
            || strpos($item->definition, $search) !== false
        ) {
            return $item;
        }
    });

    return $result;
}

function add_term($term, $definition)
{
    $terms = get_terms();

    $arr = [
        "term" => $term,
        "definition" => $definition
    ];

    $newTermObj = (object) $arr;
    $terms[] = $newTermObj;

    set_data($terms);
}
