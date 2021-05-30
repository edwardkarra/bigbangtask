<?php
namespace Tygh\Api\Entities;

use Tygh\Api\AEntity;
use Tygh\Api\Response;


class currencies extends AEntity
{
    public $name;

    public function index($id = '', $params = array())
    {
        // using only GET method because of unknown method verbs problem with Entities
        $method = $params['method'];
        switch ($method){
            case 'POST':
                $this->create($params);
                break;
            case 'PUT':
                $this->update($params['currency_id'],$params);
                break;
            case 'DELETE':
                $this->delete($params['currency_id']);
                break;

        }
        $currencies = fn_get_currencies_list();
        return array(
        'status' => Response::STATUS_OK,
        'data' => array(
            'currencies' => $currencies
        )
        );
    }

    public function create($params)
    {

        // couldn't get Create function to work

        return array(
        'status' => Response::STATUS_CREATED,
        'data' => array()
        );
    }

    public function update($id ,$params)
    {

        $cur_data = [];
        $cur_data['currency_code'] = $params['currency_code'];
        $cur_data['coefficient'] = $params['coefficient'];
        $cur_data['description'] = $params['description'];

        fn_update_currency($cur_data,$id);

        return array(
        'status' => Response::STATUS_OK,
        'data' => array()
        );
    }

    public function delete($id)
    {
        fn_delete_currency($id);
        return array(
        'status' => Response::STATUS_NO_CONTENT,
        );
    }

    public function privileges()
    {
        return array(
        'create' => 'create_things',
        'update' => 'edit_things',
        'delete' => 'delete_things',
        'index'  => 'view_things'
        );
    }
    public function privilegesCustomer()
    {
        // accessible functions from API
        return array(
            'index' => true,
        );
    }
}