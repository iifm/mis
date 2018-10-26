
<link href="https://fonts.googleapis.com/css?family=Anton|Luckiest+Guy|Oleo+Script" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">


    <div bgcolor="#F2F2F2">
        <center>
            <table align="center" bgcolor="#F2F2F2" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="m_4029179099876117027bodyTable">
                <tbody><tr>
                    <td align="center" valign="top" id="m_4029179099876117027bodyCell" style="padding-bottom:60px">
                       
                        <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
                            
                            <tbody><tr>
                                <td align="center" valign="top" bgcolor="#009688" style="background-color:#009688; padding-top: 25px;">
                                    
                                    <table align="center" border="0" cellpadding="0" cellspacing="0" style="max-width:640px" width="100%" class="m_4029179099876117027emailContainer">
                                        <tbody><tr>
                                           
                                        </tr>
                                        <tr>
                                            <td style="background-color:#ffffff; height: 25px;">&nbsp;</td>
                                        </tr>
                                    </tbody></table>
                                    
                                </td>
                            </tr>
                            
                            
                            <tr>
                                <td align="center" valign="top">
                                    
                                    <table align="center" bgcolor="#FFFFFF" border="0" cellpadding="0" cellspacing="0" style="background-color:#ffffff;max-width:640px" width="100%" class="m_4029179099876117027emailContainer">
                                        <tbody><tr>
                                            <td align="center" valign="top" bgcolor="#FFFFFF" style="padding-right:40px;padding-left:40px; margin-top: 0px;">
                                                <h1 style="color:#606060; text-align:center;font-family: 'Anton', sans-serif;font-family: 'Luckiest Guy', cursive;font-family: 'Oleo Script', cursive;" ><span class="fa fa-calendar"></span> Attendance Approval Request<br>
                                            </td>
                                        </tr>

                                         <tr>
                                            <td align="center" valign="top" style="padding-right:40px;padding-left:40px">
                                                <p style="text-align:center;margin: 20px;">  Applicant Name  &nbsp;&nbsp;<strong style="font-size: 25px;">{{$data['username']}}</strong></p> 
                                            </td>
                                        </tr>
                                        <tr> 
                                            <td>
                                                <table width="60%" style="margin-top:15px; max-width:80%;border-collapse: collapse; border:1px solid #e1e1e1;" id="leave_details" align="center">
                                                <thead>
                                                    <tr>
                                                        <td colspan="2" style="font-size: 20px; color: #606060; text-align:center; font-weight:600;padding: 5px;">
                                                            Attendance Details
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td style="min-width:120px; padding: 10px 15px;">
                                                            <strong>Attendance Date</strong>
                                                        </td>
                                                        <td style=" padding: 10px 15px;"> 
                                                           {{date('j F Y',strtotime($data['date']))}}
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td style="padding: 10px 15px; background-color: #f2f2f2">
                                                            <strong> In-Time</strong>
                                                        </td>
                                                        <td style="padding: 10px 15px; background-color: #f2f2f2">
                                                           {{$data['in_time']}}
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td style=" padding: 10px 15px;">
                                                            <strong>Out-Time </strong>
                                                        </td>
                                                        <td style=" padding: 10px 15px;">
                                                            {{$data['out_time']}}
                                                        </td>
                                                    </tr>
                                                 
                                                     <tr>
                                                    <td style="padding: 10px 15px; background-color: #f2f2f2"><strong>Reason </strong> </td>
                                                    <td style="padding: 10px 15px; background-color: #f2f2f2">{{$data['reason']}}</td>
                                                    </tr>
                                                   
                                                </thead>
                                                </table>
                                        
                                            </td>
                                        </tr>
                                
                                        <tr>
                                            <td align="center" valign="middle" style="padding-right:40px;padding-bottom:20px;padding-left:40px">
                                                
                                                <a href="{{$link}}" style="background-color:#009688;border-collapse:separate;border-top:20px solid #009688;border-right:20px solid #009688;border-bottom:20px solid #009688;border-left:20px solid #009688;border-radius:3px;color:#ffffff;display:inline-block;font-family:'Open Sans','Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:600;letter-spacing:.3px;text-decoration:none; margin-top: 30px" target="_blank" ">Click Here For Action/Response</a>
                                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center" valign="top" style="padding-right:40px;padding-bottom:40px;padding-left:40px">
                                                <p style="color:#484848;font-family:'Open Sans','Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-style:normal;font-weight:400;line-height:42px;letter-spacing:normal;margin:0;padding:0;text-align:center">Note: For Approval or Disapproval Simply Click Take Action Button.</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center" valign="top" class="m_4029179099876117027footerContent" style="border-top:2px solid #f2f2f2;color:#484848;font-family:'Open Sans','Helvetica Neue',Helvetica,Arial,sans-serif;font-size:12px;font-weight:400;line-height:24px;padding-top:40px;padding-bottom:40px;text-align:center">
                                                <p style="color:#484848;font-family:'Open Sans','Helvetica Neue',Helvetica,Arial,sans-serif;font-size:12px;font-weight:400;line-height:24px;padding:0 20px;margin:0;text-align:center"></sup><strong>Head Office <br>
                      IIFM Ltd, HS-13 2nd Floor, Kailash Colony Main Markets, New Delhi - 110048<br>
                      Phone: 011-4266600 | Email : <a href="mailto:hr@iifm.co.in" target="_blank">hr@iifm.co.in</a></strong><br><a style="color:#484848;text-decoration:none"></a></p>
                                               
                                            </td>
                                        </tr>
                                    </tbody></table>
                                    
                                </td>
                            </tr>
                            
                        </tbody></table>
                    </td>
                </tr>
            </tbody></table>
        </center>
   

</div></div></div></div></div>