<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Document</title>
    <style>
        header { 
            /* position: fixed;
            left: 0px;
            top: -30px;
            right: 0px; */

            position: fixed;
            top: -30px;
            left: 0;
            right: 0;
            /* background-color: #ccc; */
            /* border-bottom: 1px solid #1f1f1f; */
            z-index: 1000;
        }

        body{
            font-size: 12px;
            width: auto;
            height: 595px;
            font-family : sans-serif;
            /* background: #F19999; */
        }
        
        .wrapper {
            height:100px;
            width:100%;
        }

        .page-first{
            width : 50%;
            /* background: red; */
            float: left;
        }

        .page-second {
            width: 50%;
            /* background: green; */
            float: right;
        }

        .page-thirt {
            width: 100%;
            padding-right: 3%;
            padding-top: 15%;
            margin-top: 3rem;
            /* background: red; */
        }

        .img-logo {
            margin-left: 35px;
            width: 70%;
        }

        .text-center {
            text-align: center;
        }

        .pt--15 {
            padding-top: -15px;
        }

        .table {
            margin-left : 10px;
            width: 100%;
            max-width: 100%;
            margin-bottom: 20px;
            border-spacing: 0;
        }
        
        tr {
            display: table-row;
            vertical-align: inherit;
            border-color: inherit;
        }

        .tr-score, .th-score, .td-score {
            border: 1px solid black;
        }

        .th-score {
            padding : 6.2px;
        }

        .th-second {
            padding : 2px;
        }

        .pull-right {
            float: right;
        }

        .pull-left {
            float: left;
        }

        .score {
            padding-left: -15px;
        }

        .font-mandarin {
            font-family:'Kaiti' !important;
        }

        .section {
            background-color: ccc;
            /* border: brown solid; */
            height: 150px;
        }

    </style>
</head>
<body>
    <header>
        <div class="wrapper">
            <div class="page-first">
                <img src="<?=base_url()?>assets/CLC-Logo11.png" alt="logo_clc.png" class="img-logo">
                <h3 class="text-center pt--15">Meaning Test</h3>
                    <div class="score">
                        <table class="table text-center">
                            <tbody>
                                <tr class="tr-score">
                                    <th class="th-score" style="background-color:#ff6e6e !important">Score</th>
                                    <td class="td-score" colspan="2" style="background-color:#ff6e6e !important">5 / 11</td>
                                </tr>
                                <tr>
                                    <th class="th-score" style="background-color:#ff6e6e !important">%</th>
                                    <td class="td-score" style="background-color:#ff6e6e !important">45%</td>
                                    <td class="td-score" style="background-color:#ff6e6e !important">-6</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
            </div>
            
            <div class="page-second">
                <table class="table text-center">
                    <tbody>
                        <tr>
                            <th class="th-second">Name Student :</th>
                            <td style="background-color:#ff6e6e !important">Teacher000</td>
                        </tr>
                        <tr>
                            <th class="th-second">Student ID :</th>
                            <td>WT000</td>
                        </tr>
                        <tr>
                            <th class="th-second">Product / Class :</th>
                            <td>Pr111 / CL001</td>
                        </tr>
                        <tr>
                            <th class="th-second">Subject :</th>
                            <td style="background-color:#ff6e6e !important">NXX4B MT</td>
                        </tr>
                        <tr>
                            <th class="th-second">Unit :</th>
                            <td style="background-color:#ff6e6e !important">10 （1）</td>
                        </tr>
                        <tr>
                            <th class="th-second">Exam Time :</th>
                            <td>2020-03-10 10:29</td>
                        </tr>
                        <tr>
                            <th class="th-second">Time Elapsed :</th>
                            <td>00:23</td>
                        </tr>
                        <tr>
                            <th class="th-second">Exam :</th>
                            <td style="background-color:#ff6e6e !important">5</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </header>

    <div class="wrapper">
        <div class="page-thirt">
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-center" style="width:25%; text-decoration: underline;">Question</th>
                        <th class="text-center" style="width:25%; border-right: 3px solid #000 !important; text-decoration: underline;">Choices</th>
                        <th class="text-center" colspan="2" style="text-decoration: underline;">Reviews</th>
                    </tr>
                </thead>
                <tbody style="font-family:'Noto Serif SC' !important;">
                    <tr>
                        <td class="text-center">
                            <div style="color:black; font-size:12.5px !important">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td class="text-center font-mandarin">wú</td>
                                            <td class="text-center font-mandarin">lǐ</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">
                                                <span class="font-mandarin" style="font-size: 23px !important">无</span>
                                            </td>
                                            <td class="text-center">
                                                <span class="font-mandarin" style="font-size: 23px !important">礼</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </td>
                        <td class="text-center" style="color:red !important; vertical-align:middle; border-right: 3px solid #000 !important;">No matter</td>
                        <td class="text-center" style="border-bottom: 2px solid #000">
                            <div style="color:red; font-size:12.5px !important">
                                <table class="table" style="width:90% !important">
                                    <tbody>
                                        <tr>
                                            <td class="text-center font-mandarin">wú</td>
                                            <td class="text-center font-mandarin">lǐ</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">
                                                <span class="font-mandarin" style="font-size: 23px !important">无</span>
                                            </td>
                                            <td class="text-center">
                                                <span class="font-mandarin" style="font-size: 23px !important">礼</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </td>
                        <td class="text-center" style="color:blue !important; vertical-align:middle; border-bottom: 2px solid #000">No matter</td>
                    </tr>
                    <tr>
                        <td class="text-center">
                            <div style="color:black; font-size:12.5px !important">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td class="text-center font-mandarin">wú</td>
                                            <td class="text-center font-mandarin">lǐ</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">
                                                <span class="font-mandarin" style="font-size: 23px !important">无</span>
                                            </td>
                                            <td class="text-center">
                                                <span class="font-mandarin" style="font-size: 23px !important">礼</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </td>
                        <td class="text-center" style="color:red !important; vertical-align:middle; border-right: 3px solid #000 !important;">No matter</td>
                        <td class="text-center" style="border-bottom: 2px solid #000">
                            <div style="color:red; font-size:12.5px !important">
                                <table class="table" style="width:90% !important">
                                    <tbody>
                                        <tr>
                                            <td class="text-center font-mandarin">wú</td>
                                            <td class="text-center font-mandarin">lǐ</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">
                                                <span class="font-mandarin" style="font-size: 23px !important">无</span>
                                            </td>
                                            <td class="text-center">
                                                <span class="font-mandarin" style="font-size: 23px !important">礼</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </td>
                        <td class="text-center" style="color:blue !important; vertical-align:middle; border-bottom: 2px solid #000">No matter</td>
                    </tr>
                    <tr>
                        <td class="text-center">
                            <div style="color:black; font-size:12.5px !important">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td class="text-center font-mandarin">wú</td>
                                            <td class="text-center font-mandarin">lǐ</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">
                                                <span class="font-mandarin" style="font-size: 23px !important">无</span>
                                            </td>
                                            <td class="text-center">
                                                <span class="font-mandarin" style="font-size: 23px !important">礼</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </td>
                        <td class="text-center" style="color:red !important; vertical-align:middle; border-right: 3px solid #000 !important;">No matter</td>
                        <td class="text-center" style="border-bottom: 2px solid #000">
                            <div style="color:red; font-size:12.5px !important">
                                <table class="table" style="width:90% !important">
                                    <tbody>
                                        <tr>
                                            <td class="text-center font-mandarin">wú</td>
                                            <td class="text-center font-mandarin">lǐ</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">
                                                <span class="font-mandarin" style="font-size: 23px !important">无</span>
                                            </td>
                                            <td class="text-center">
                                                <span class="font-mandarin" style="font-size: 23px !important">礼</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </td>
                        <td class="text-center" style="color:blue !important; vertical-align:middle; border-bottom: 2px solid #000">No matter</td>
                    </tr>
                    <tr>
                        <td class="text-center">
                            <div style="color:black; font-size:12.5px !important">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td class="text-center font-mandarin">wú</td>
                                            <td class="text-center font-mandarin">lǐ</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">
                                                <span class="font-mandarin" style="font-size: 23px !important">无</span>
                                            </td>
                                            <td class="text-center">
                                                <span class="font-mandarin" style="font-size: 23px !important">礼</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </td>
                        <td class="text-center" style="color:red !important; vertical-align:middle; border-right: 3px solid #000 !important;">No matter</td>
                        <td class="text-center" style="border-bottom: 2px solid #000">
                            <div style="color:red; font-size:12.5px !important">
                                <table class="table" style="width:90% !important">
                                    <tbody>
                                        <tr>
                                            <td class="text-center font-mandarin">wú</td>
                                            <td class="text-center font-mandarin">lǐ</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">
                                                <span class="font-mandarin" style="font-size: 23px !important">无</span>
                                            </td>
                                            <td class="text-center">
                                                <span class="font-mandarin" style="font-size: 23px !important">礼</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </td>
                        <td class="text-center" style="color:blue !important; vertical-align:middle; border-bottom: 2px solid #000">No matter</td>
                    </tr>
                    <tr>
                        <td class="text-center">
                            <div style="color:black; font-size:12.5px !important">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td class="text-center font-mandarin">wú</td>
                                            <td class="text-center font-mandarin">lǐ</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">
                                                <span class="font-mandarin" style="font-size: 23px !important">无</span>
                                            </td>
                                            <td class="text-center">
                                                <span class="font-mandarin" style="font-size: 23px !important">礼</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </td>
                        <td class="text-center" style="color:red !important; vertical-align:middle; border-right: 3px solid #000 !important;">No matter</td>
                        <td class="text-center" style="border-bottom: 2px solid #000">
                            <div style="color:red; font-size:12.5px !important">
                                <table class="table" style="width:90% !important">
                                    <tbody>
                                        <tr>
                                            <td class="text-center font-mandarin">wú</td>
                                            <td class="text-center font-mandarin">lǐ</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">
                                                <span class="font-mandarin" style="font-size: 23px !important">无</span>
                                            </td>
                                            <td class="text-center">
                                                <span class="font-mandarin" style="font-size: 23px !important">礼</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </td>
                        <td class="text-center" style="color:blue !important; vertical-align:middle; border-bottom: 2px solid #000">No matter</td>
                    </tr>
                    <tr>
                        <td colspan="4" style="border : black solid 2px; height: 400px; margin-top:3rem;">TESTING</td>
                    </tr>
                </tbody>
            </table>
            
            <!-- <section class="section">
                <table class="table">
                
                </table>
            </section>

            <table class="table">
                <thead>
                    <tr>
                        <th class="text-center" style="width:25%; text-decoration: underline;">Question</th>
                        <th class="text-center" style="width:25%; border-right: 3px solid #000 !important; text-decoration: underline;">Choices</th>
                        <th class="text-center" colspan="2" style="text-decoration: underline;">Reviews</th>
                    </tr>
                </thead>
                <tbody style="font-family: 'Noto Serif SC' !important">
                    <tr>
                        <td class="text-center">
                            <div style="color:black; font-size:12.5px !important">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td class="text-center font-mandarin">wú</td>
                                            <td class="text-center font-mandarin">lǐ</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">
                                                <span class="font-mandarin" style="font-size: 23px !important">无</span>
                                            </td>
                                            <td class="text-center">
                                                <span class="font-mandarin" style="font-size: 23px !important">礼</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </td>
                        <td class="text-center" style="color:red !important; vertical-align:middle; border-right: 3px solid #000 !important;">No matter</td>
                        <td class="text-center" style="border-bottom: 2px solid #000">
                            <div style="color:red; font-size:12.5px !important">
                                <table class="table" style="width:90% !important">
                                    <tbody>
                                        <tr>
                                            <td class="text-center font-mandarin">wú</td>
                                            <td class="text-center font-mandarin">lǐ</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">
                                                <span class="font-mandarin" style="font-size: 23px !important">无</span>
                                            </td>
                                            <td class="text-center">
                                                <span class="font-mandarin" style="font-size: 23px !important">礼</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </td>
                        <td class="text-center" style="color:blue !important; vertical-align:middle; border-bottom: 2px solid #000">No matter</td>
                    </tr>
                    <tr>
                        <td class="text-center">
                            <div style="color:black; font-size:12.5px !important">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td class="text-center font-mandarin">wú</td>
                                            <td class="text-center font-mandarin">lǐ</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">
                                                <span class="font-mandarin" style="font-size: 23px !important">无</span>
                                            </td>
                                            <td class="text-center">
                                                <span class="font-mandarin" style="font-size: 23px !important">礼</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </td>
                        <td class="text-center" style="color:red !important; vertical-align:middle; border-right: 3px solid #000 !important;">No matter</td>
                        <td class="text-center" style="border-bottom: 2px solid #000">
                            <div style="color:red; font-size:12.5px !important">
                                <table class="table" style="width:90% !important">
                                    <tbody>
                                        <tr>
                                            <td class="text-center font-mandarin">wú</td>
                                            <td class="text-center font-mandarin">lǐ</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">
                                                <span class="font-mandarin" style="font-size: 23px !important">无</span>
                                            </td>
                                            <td class="text-center">
                                                <span class="font-mandarin" style="font-size: 23px !important">礼</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </td>
                        <td class="text-center" style="color:blue !important; vertical-align:middle; border-bottom: 2px solid #000">No matter</td>
                    </tr>
                    <tr>
                        <td class="text-center">
                            <div style="color:black; font-size:12.5px !important">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td class="text-center font-mandarin">wú</td>
                                            <td class="text-center font-mandarin">lǐ</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">
                                                <span class="font-mandarin" style="font-size: 23px !important">无</span>
                                            </td>
                                            <td class="text-center">
                                                <span class="font-mandarin" style="font-size: 23px !important">礼</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </td>
                        <td class="text-center" style="color:red !important; vertical-align:middle; border-right: 3px solid #000 !important;">No matter</td>
                        <td class="text-center" style="border-bottom: 2px solid #000">
                            <div style="color:red; font-size:12.5px !important">
                                <table class="table" style="width:90% !important">
                                    <tbody>
                                        <tr>
                                            <td class="text-center font-mandarin">wú</td>
                                            <td class="text-center font-mandarin">lǐ</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">
                                                <span class="font-mandarin" style="font-size: 23px !important">无</span>
                                            </td>
                                            <td class="text-center">
                                                <span class="font-mandarin" style="font-size: 23px !important">礼</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </td>
                        <td class="text-center" style="color:blue !important; vertical-align:middle; border-bottom: 2px solid #000">No matter</td>
                    </tr>
                    <tr>
                        <td class="text-center">
                            <div style="color:black; font-size:12.5px !important">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td class="text-center font-mandarin">wú</td>
                                            <td class="text-center font-mandarin">lǐ</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">
                                                <span class="font-mandarin" style="font-size: 23px !important">无</span>
                                            </td>
                                            <td class="text-center">
                                                <span class="font-mandarin" style="font-size: 23px !important">礼</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </td>
                        <td class="text-center" style="color:red !important; vertical-align:middle; border-right: 3px solid #000 !important;">No matter</td>
                        <td class="text-center" style="border-bottom: 2px solid #000">
                            <div style="color:red; font-size:12.5px !important">
                                <table class="table" style="width:90% !important">
                                    <tbody>
                                        <tr>
                                            <td class="text-center font-mandarin">wú</td>
                                            <td class="text-center font-mandarin">lǐ</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">
                                                <span class="font-mandarin" style="font-size: 23px !important">无</span>
                                            </td>
                                            <td class="text-center">
                                                <span class="font-mandarin" style="font-size: 23px !important">礼</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </td>
                        <td class="text-center" style="color:blue !important; vertical-align:middle; border-bottom: 2px solid #000">No matter</td>
                    </tr>
                </tbody>
            </table> -->
        </div>

    </div>
</body>
</html>