<?php

namespace app\controllers;
// use mpdf;
use Mpdf\Mpdf;
use yii\base\Model\Invoice;
class InvoiceController extends \yii\web\Controller

{
    public function actionGet(){
        return $this->render('invoice');
    }

    public function actionAddItems($request = array()){
        Invoice::store($request);
    }


    public function actionWriteHtml(){
        $text = 
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
                  <td align="right">Invoice #<span style="padding-left: 15px;font-weight: bold;font-size: 14px;">000321</span></td>
                </tr>
                <tr>
                  <td align="right">Date<span style="padding-left: 15px;font-weight: bold;font-size: 14px;">May 07,2020</span></td>
                </tr>
                <tr>
                  <td align="right">Amount Due<span style="padding-left: 15px;font-weight: bold;font-size: 14px;">$875.00</span></td>
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
                  <tr>
                    <td align="center">web updates</td>
                    <td align="center" style="width: 350px;">Monthly web updates for http://widgetcrop.com 
                      <span style="display: inline-block;">(nov. 1 - Nov.30,209)</span>
                    </td>
                    <td align="center">$650.00</td>
                    <td align="center">1</td>
                    <td align="center">$650.00</td>
                  </tr>
                  <tr>
                    <td align="center">web updates</td>
                    <td align="center">Monthly web updates for http://widgetcrop.com
                      <span style="display: inline-block;">(nov. 1 - Nov.30,209)</span>
                    </td>
                    <td align="center">$650.00</td>
                    <td align="center">1</td>
                    <td align="center">$650.00</td>
                  </tr>
                  <tr>
                    <td align="center">web updates</td>
                    <td align="center">Monthly web updates for http://widgetcrop.com
                      <span style="display: inline-block;">(nov. 1 - Nov.30,209)</span>
                    </td>
                    <td align="center">$650.00</td>
                    <td align="center">1</td>
                    <td align="center">$650.00</td>
                  </tr>
                </table> 
            </td>
          </tr>
        
          <tr>
            <td colspan="2" align="right"> 
              <a class="primary-buttons" href="#">Add a row</a>
              <a class="primary-buttons" href="#">Delete a Row</a>
              <a class="primary-buttons" href="#">test</a>
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

    public function actionGenerate(){
        $html = $this->actionWriteHtml();
        $mpdf = new mPDF();
        $mpdf->WriteHTML($html);
        $mpdf->Output("TestInvoice.pdf", 'F');
        $mpdf->Output();
    }

    public function actionSend(){
        $email = "";
       Invoice::send($email);
    }
}