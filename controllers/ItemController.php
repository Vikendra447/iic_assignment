<?php
namespace app\controllers;
use Yii;
use Mpdf\Mpdf;
use app\models\Items;
use yii\db\Query;
class ItemController extends \yii\web\Controller

{
    public function actionIndex(){
        $data = $this->actionGetData();
        return $this->render('index',['data' => $data]);
    }

    public function actionGetData(){
        $data = Items::find()->all();
        return $data;
    }

    public function actionAdd(){
        return $this->render('add');
    }

    public function actionUpdate($id){
        $data = Items::findOne($id);
        return $this->render('update',['data'=> $data]);
    }
    
    public function actionSave(){  
        $items = new Items();
        $data = Yii::$app->request->post();

        if(!empty($data['id'])){
            $items = Items::findOne($data['id']);
            $items->load($data);
        }
   
        $items->load($data);
        $items->name = $data['name'];
        $items->description = $data['description'];
        $items->unit_cost = $data['unit_cost'];
        $items->quantity = $data['quantity'];
        $items->price = $data['unit_cost']*$data['quantity'];
        $items->save();
        return true;
    }

    public function actionDalete($id){
        $items = Items::findOne($id)->delete();
        return $this->redirect(Yii::$app->request->referrer);

    }

    public function actionDownloadInvoice(){
        $html = $this->actionWriteHtml();
        $mpdf = new mPDF();
        $mpdf->WriteHTML($html);
        $mpdf->Output("TestInvoice.pdf", 'F');
        $mpdf->Output();
    }
      public function actionSendInvoice(){
          Yii::$app->mailer->compose()
       ->setFrom('abc@gmail.com')
       ->setTo('xyz@gmail.com')
       ->setSubject('Email sent from Yii2-Swiftmailer')
       ->send();
      }
  
      public function actionWriteHtml(){
      
          $invoice_id = 000321;
          $query = new Query();
          $query->select('*,sum(unit_cost) as total_cost,sum(price) as total_price')->from('items');
          $command = $query->createCommand();
          $records = $command->queryAll();
          
          $html = '<!doctype html>
          <html>
          <head>
          <meta charset="utf-8">
          <title>Untitled Document</title>
          <style type="text/css">
          .primary-buttons {
          background-color:#1a73e8;color: #fff;
          text-decoration: none;padding: 0 12px;height: 30px;line-height: 30px;
          display: inline-block;font-size: 13px;border-radius: 3px;
          margin-left: 5px;
          }
          body{margin:0;padding:0; font-family:Arial; font-size:15px; color:#444;line-height: 24px;}
          
          .container{width:1000px; margin:0 auto;}
          .tittle{text-align:center;height: 55px; line-height:55px; color:#fff; font-size:22px; font-weight:bold; font-family:Arial;}
          .heading2{margin:8px 0;padding:0; color:#d24b27; font-size:20px; font-weight:bold; text-transform:capitalize;}
          #billing-tbl{border: 1px #ddd solid;}
          #billing-tbl tr th{border: none; border-right: 2px #c7dfff solid; border-bottom: 2px #c7dfff solid; border-top: 1px #c7dfff solid; padding: 10px 10px; background: #ecf4ff; color: #5a89c7;}
          #billing-tbl tr th{text-align: center;}
          
          #billing-tbl tr td{border: none; border-right: 1px #ddd solid;border-bottom: 1px #ddd solid;padding:11px 12px;text-align: center;}
          #billing-tbl tr td{text-align: center;}
          
          .tbl{border: 1px #c25133 solid;padding: 0 1px;}
          .tbl tr th{border: none; /*border-right: 1px #ddd solid;*/border-bottom: 1px #e5e5e5 solid;padding: 10px 10px;background: #f0f0f0}
          .tbl tr th{text-align: left;}
          /*.tbl tr th:nth-child(1){width: 10%;}*/
          
          .tbl tr td{border: none; /*border-right: 1px #ddd solid;border-bottom: 1px #ddd solid;*/padding:5px 12px;text-align: center;}
          .tbl tr td{text-align: left;/*width: 20%*/}
          /*.tbl tr td:nth-child(1){width: 10%;}*/
          .tbl tr:nth-child(2) td{padding-top: 12px;}
          .tbl tr:last-child td{padding-bottom: 12px;padding-top: 10px; border-top: 1px #c25133 solid;}
          
          
          .tbl2{border: 1px #c25133 solid;padding: 0 1px;}
          .tbl2 tr th{border: none; /*border-right: 1px #ddd solid;*/border-bottom: 1px #e5e5e5 solid;padding: 10px 10px;background: #f0f0f0}
          .tbl2 tr th{text-align: left;}
          /*.tbl tr th:nth-child(1){width: 10%;}*/
          
          .tbl2 tr td{border: none; /*border-right: 1px #ddd solid;border-bottom: 1px #ddd solid;*/padding:5px 12px;text-align: center;}
          .tbl2 tr td{text-align: left;width: 20%}
          .tbl2 tr td:nth-child(1){width: 10%;}
          .tbl2 tr:nth-child(2) td{padding-top: 12px;}
          .tbl2 tr:last-child td{padding-bottom: 12px;}
          
          #subtotal_tbl{border: none !important;}
          #subtotal_tbl tr td{width: 50% !important; border-bottom: 1px #ddd solid !important;}
          #subtotal_tbl tr td:last-child{border-right: none !important;}
          #subtotal_tbl tr:last-child td{border-bottom: none !important;}
          </style>
          </head>
          
          
          <body>
          
          <div class="container">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
          
            <tr>
              <td colspan="2" style="vertical-align: top; padding-top: 20px;">
                <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top: 12px;">
                  <tr>
                    <td align="right">Invoice #<span style="padding-left: 15px;font-weight: bold;font-size: 14px;">' .$invoice_id.'</span></td>
                  </tr>
                  <tr>
                    <td align="right">Date <span style="padding-left: 15px;font-weight: bold;font-size: 14px;">' .date('F d Y').'</span></td>
                  </tr>
                  <tr>
                    <td align="right">Amount Due<span style="padding-left: 15px;font-weight: bold;font-size: 14px;"> $875.00</span></td>
                  </tr>
                  <tr>
                    <td align="right"><br /></td>
                  </tr>
                </table>
              </td>
            </tr>
            
            <tr>
              <td colspan="2" class="tittle" style="background:#1a73e8;height: 3px;"></td>
            </tr>
          
            <tr>
              <td align="right"><br /></td>
            </tr>
            
            
            <tr>
                <td colspan="2" style="padding: 10px 0;">
                  <table id="billing-tbl" width="100%" border="1" cellspacing="0" cellpadding="0">
                    <tr>
                      <th align="center">Item</th>
                      <th align="center">Description</th>
                      <th align="center">Unit Cost</th>
                      <th align="center">Quantity</th>
                      <th align="center">Price</th>
                    </tr>
                    <tr>';
                    foreach($records as $item) {
                          $html.='<td align="center">'.$item['name'].'</td>';
                          $html.='<td align="center" style="width: 350px;">'.$item['description'].'</td>';
                          $html.='<td align="center">'.$item['unit_cost'].'</td>';
                          $html.='<td align="center">'.$item['quantity'].'</td>';
                          $html.='<td align="center">'.$item['price'].'</td>';
                    }
                      $html.='</tr>
                  </table> 
              </td>
            </tr>
          
            <tr>
              <td align="left" style="padding: 15px 15px 15px 0;" width="50%" valign="top">
                
              </td>
              <td align="right" style="padding: 15px 0 15px 15px;" width="50%" valign="top">
                <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px #1a73e8 solid;">
                  <tr>
                    <td>
                      <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin: 10px 0;">
                        <tr>
                          <td style="padding:3px 12px;" width="60%">Subtotal</td>
                          <td style="padding:3px 12px;" width="40%">$875.00</td>
                        </tr>
                        <tr>
                          <td style="padding:3px 12px;" width="60%">Total</td>
                          <td style="padding:3px 12px;" width="40%">$875.00</td>
                        </tr>
                        <tr>
                          <td style="padding:3px 12px;" width="60%">Amount Paid</td>
                          <td style="padding:3px 12px;" width="40%"><b>$0.00</b></td>
                        </tr>
                        <tr>
                          <td style="padding:10px 12px 0;color: #1a73e8;font-size: 16px;border-top: 1px #1a73e8 solid;" width="60%"><b>Balance Due</b></td>
                          <td style="padding:10px 12px 0;color: #1a73e8;font-size: 16px;border-top: 1px #1a73e8 solid;" width="40%"><b>$875.00</b></td>
                        </tr>
                        
                      </table>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          
          </table>
          </div>
          </body>
          </html>';
          return $html;
      }
}