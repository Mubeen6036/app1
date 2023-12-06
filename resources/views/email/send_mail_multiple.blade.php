<title>{{$settings->site_title}}</title>
<table width="100%" style="font-family: arial, sans-serif; font-size: 13px;" border="0" cellpadding="10" cellspacing="0">
    <tr>
        <td bgcolor="#eeeeee">
            <table align="center" width="600" cellpadding="0" cellspacing="0" style="background-color:#fff">
                <tr>
                    <td  align="center" style="padding: 10px;">
                     
                    <img  src="{{url('public/uploads/')}}/{{$settings->logo}}" alt="Logo"  width="158" border="0" hspace="0" vspace="0">
                    </td>
                </tr>
                <tr>
                    <td bgcolor="#00acce" height="2">
					{{$settings->logo}}
                    </td>
                </tr>
                <tr>
                    <td bgcolor="#fff" style="padding:25px">
                        <table width="550" align="center" cellpadding="0" cellspacing="0" border="0">
                            <tr>
                                <td style="font-family: arial, sans-serif;  font-size: 16px; line-height: 1.7">
                                   <h4> dear ,{!! $data['name'] !!}  you have message form {{$settings->site_title}} </h4>
                                   <p>{!! $data['messages'] !!}</p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>   
                
                <tr>
                    <td>
                        <table align="center" width="600" border="0" cellpadding="0" cellspacing="0" style="background-color:#00acce">
                            <tr>
                                 <td style="padding: 10px;" align="center">
                                 <strong > 
                                 <a style="color:#fff; font-family: arial, sans-serif; font-size: 18px;" href="{{$settings->site_url}}" target="_blank" >{{$settings->site_title}}</a>
                                 </strong>
                                 </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>