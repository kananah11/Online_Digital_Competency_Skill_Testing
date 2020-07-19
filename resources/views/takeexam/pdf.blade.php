<html>



<style>



table, th, td {


}

.dam{
    /* background-color: #FFBE7D; */


}

</style>

        <div class="dam" >

            <div class="row" align="center">
                <img src="/images/pictures/kmutnb_Logo.png" width="100" height="100" />
                <h1> KING MONGKUT'S UNIVERSITY OF TECHNOLOGY NORTH BANGKOK</h1>
                <br>
                <h3>CERTIFICATE OF ACHIVEMENT</h3>
                <p>This is to certify that</p>
                <h1>{{$certificate->name}}</h1>
                <p>achieved the digital literacy skills through the successful completion of the examinations</p>
                <br>
                <br>
            </div>


    <div> </div>

            <table  >
                <tr><td colspan="3" align="center" ><img  src="/images/{{$certificate->signa_pic}}" height="50px"/></td><td></td> <td></td><td></td><td></td></tr>
                <tr><td colspan="2" align="rightr" >
                        <p align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$certificate->signa_name}}</p>
                        <p align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$certificate->signa_pos}} </p>
                    </td>

                    <td></td> <td></td><td></td>
                    <td  >

                        <p>{{  date('d-M-Y', strtotime( $certificate->date)) }}</p>
                        <p >DATE ISSUED</p>


                    </td>
                    <td><div  ><img src="{{$certificate->qrcode}}" width="85px" /></div></td>





                </tr>
            </table>




            </div>

</html>
