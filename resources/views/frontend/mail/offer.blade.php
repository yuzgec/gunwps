<!DOCTYPE html>
<html lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Westerpark Studio</title>
    </head>

    <body style="margin: 20px auto;">
        <table style="width: 600px">
            <tbody>
            <tr>
                <td>
                    <table >
                        <tbody>
                            <tr>
                                <td><img src="https://westerparkstudio.nl/logo.jpg" alt="WesterPark" style="margin-bottom: 10px;width: 100%;"></td>
                            </tr>
                            <tr>
                                <td><h2 class="title">CUSTOMER INFORMATION</h2></td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="order-detail" >
                        <tbody>
                            <tr>
                            <td colspan="2">Name:</td>
                            <td colspan="3" class="price"><b>{{ $New->name }}</b></td>
                        </tr>
                        <tr>
                            <td colspan="2">Company:</td>
                            <td colspan="3" class="price"><b>{{ $New->company }}</b></td>
                        </tr>
                        <tr>
                            <td colspan="2">Email :</td>
                            <td colspan="3" class="price"><b>{{ $New->email }}</b></td>
                        </tr>
                        <tr>
                            <td colspan="2">Phone: </td>
                            <td colspan="3" class="price"><b>{{ $New->phone }}</b> </td>
                        </tr>
                        <tr>
                            <td >Message :</td>
                            <td colspan="3" class="price"> <b>{{ $New->message }}</b></td>
                        </tr>

                        <tr>
                            <td colspan="2" s>Address :</td>
                            <td colspan="3" class="price"> <b>{{ $New->address }}</b></td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            </tbody>
        </table>
        <table style="width: 600px">

            <tbody>
            <tr>
                <td>
                    <table>
                        <tbody>
                            <tr>
                                <td><h2 class="title">OFFER DETAIL</h2></td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="order-detail" >
                        <tbody>
                        <tr>
                            <td colspan="2">Locale:</td>
                            <td colspan="3" class="price"><b>{{ $New->locale }}</b></td>
                        </tr>
                        <tr>
                            <td colspan="2">Day:</td>
                            <td colspan="3" class="price"><b>X{{ $New->day }}</b></td>
                        </tr>
                        <tr>
                            <td colspan="2">Subtotal :</td>
                            <td colspan="3" class="price"><b>{{ $New->subtotal }}</b></td>
                        </tr>
                        <tr>
                            <td colspan="2">Vat %21: </td>
                            <td colspan="3" class="price"><b>{{ $New->vat }}</b></td>
                        </tr>
                        <tr>
                            <td >Total :</td>
                            <td colspan="3" class="price"><b>{{ $New->totalprice }}</b></td>
                        </tr>

                        </tbody>
                    </table>
                </td>
            </tr>
            </tbody>
        </table>

        <table style="width: 600px">
            <tbody>
            <tr>
                <td>
                    <table>
                        <tbody>
                            <tr><td><h2 class="title">PRODUCT DETAIL</h2> </td> </tr>
                        </tbody>
                    </table>

                    <table class="order-detail" >
                        <tbody>
                            @foreach($Product as $item)
                                <tr>
                                    <td>{{ $item->sku }}</td>
                                    <td>
                                        <img src="{{ (!$item->getFirstMediaUrl('page')) ? '/backend/resimyok.jpg': $item->getFirstMediaUrl('page', 'img')}}" width="100px" height="100px"/>
                                    </td>
                                    <td>{{ $item->title }}:</td>
                                    <td><b>{{  $item->price  }}</b></td>
                                    <td><b>{{  $item->getBrand->title  }}</b></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </td>
            </tr>
            </tbody>
        </table>
    </body>

</html>
