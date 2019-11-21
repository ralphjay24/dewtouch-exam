<?php
	class OrderReportController extends AppController{

		public function index(){

			$this->setFlash('Multidimensional Array.');

			$this->loadModel('Order');
			$orders = $this->Order->find('all',array('conditions'=>array('Order.valid'=>1),'recursive'=>2));
			// debug($orders);exit;

			$this->loadModel('Portion');
			$portions = $this->Portion->find('all',array('conditions'=>array('Portion.valid'=>1),'recursive'=>2));
			// debug($portions);exit;

			$orders = $this->Order->find('all', array('conditions'=>array('Order.valid'=>1),'recursive'=>2));
			// debug($portions);exit;

			$order_reports = [];
			foreach ($orders as $order) {
				foreach ($order['OrderDetail'] as $key => $detail) {
					$order_reports[$order['Order']['name']]['dish'][] = [
						'name' => $detail['Item']['name'],
						'quantity' => $detail['quantity']
					];

					$portions = $this->Portion->find('first',array('conditions'=>array('Portion.valid'=>1, 'Item.id' => $detail['Item']['id']),'recursive'=>2));

					$order_reports[$order['Order']['name']]['ingredients'][$key] = [
						'title' => 'Ingredient of ' . $detail['Item']['name'],
					];

					foreach ($portions['PortionDetail'] as $portion) {
						$order_reports[$order['Order']['name']]['ingredients'][$key]['ingredient_name'][] = [
							'name' => $portion['Part']['name'],
							'value' => number_format((float)$portion['value'] * $detail['quantity'], 2, '.', '')
						];
					}
				}
			}

			// To Do - write your own array in this format
			// $order_reports = array('Order 1' => array(
			// 							'Ingredient A' => 1,
			// 							'Ingredient B' => 12,
			// 							'Ingredient C' => 3,
			// 							'Ingredient G' => 5,
			// 							'Ingredient H' => 24,
			// 							'Ingredient J' => 22,
			// 							'Ingredient F' => 9,
			// 						),
			// 					  'Order 2' => array(
			// 					  		'Ingredient A' => 13,
			// 					  		'Ingredient B' => 2,
			// 					  		'Ingredient G' => 14,
			// 					  		'Ingredient I' => 2,
			// 					  		'Ingredient D' => 6,
			// 					  	),
			// 					);

			// ...

			$this->set('order_reports',$order_reports);

			$this->set('title',__('Orders Report'));
		}

		public function Question(){

			$this->setFlash('Multidimensional Array.');

			$this->loadModel('Order');
			$orders = $this->Order->find('all',array('conditions'=>array('Order.valid'=>1),'recursive'=>2));

			// debug($orders);exit;

			$this->set('orders',$orders);

			$this->loadModel('Portion');
			$portions = $this->Portion->find('all',array('conditions'=>array('Portion.valid'=>1),'recursive'=>2));

			// debug($portions);exit;

			$this->set('portions',$portions);

			$this->set('title',__('Question - Orders Report'));
		}

	}