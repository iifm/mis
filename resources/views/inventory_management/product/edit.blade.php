<!DOCTYPE html>
<html lang="en">
  
<head>
  
    <title>IIFM MIS</title>
    
    

    <!-- Main CSS-->
    {!!View('partials.include_css')!!}
 <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
   

   </head>
    

  </head>
  
  <body class="app sidebar-mini rtl">
    <!-- Navbar-->
    
    {!!View('partials.header')!!}

    <!-- Sidebar menu-->
    {!!View('partials.sidebar')!!}

    <!-- Main Content-->
  <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-product-hunt "></i> Product Management </h1>
        </div>
      </div>
      <div class="row  tile">
      <!--   <a href="#" class="btn btn-primary fa fa-plus add_course">ADD</a> -->
       <a href="{{URL::previous()}}" class="fa fa-arrow-circle-left btn btn-danger"> Back</a>
        <div class="col-md-12">
           @foreach($product as $value)
          <form action="{{route('product.update',$value->id)}}" method="post" enctype="multipart/form-data"  autocomplete="off">

            {{ csrf_field() }}
            {{method_field('PUT')}}
          <ul style="list-style-type: none;" class="education_form">
            <li>
             
              <div class="row">
            <div class="col-md-12">
               <div class="col-md-4"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Product Code</label>
                    <input class="form-control" id="pcode" name="pcode" type="text" aria-describedby="emailHelp" placeholder="Product Code" readonly="">
                </div>
             </div>
             
             <div class="col-md-4"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Product Category</label>
                    <select class="form-control" name="category" required="" id="category">
                      <option value="{{$value->category}}">{{$value->product_cat_name}}</option>
                      <option value="LAPTOP">LAPTOP</option>
                      <option value="MOBILE">MOBILE</option>
                      <option value="TABLET">TABLET</option>
                      <option value="KEYBOARD">KEYBOARD</option>
                      <option value="MOUSE">MOUSE</option>
                      <option value="TAKENOTE/DIGIPAD">TAKENOTE/DIGIPAD</option>
                      <option value="SIM CARD">SIM CARD</option>
                      <option value="OTHERS">OTHERS</option>
                    </select>
                </div>
             </div>
            <div class="col-md-4"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Product Name</label>
                    <input class="form-control" value="{{$value->pname}}" id="pname" name="pname" type="text" aria-describedby="emailHelp" placeholder="Product Name" required="">
                </div>
             </div>
             <div class="col-md-4"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Product Company</label>
                   <input class="form-control" id="pcompany" value="{{$value->pcompany}}" name="pcompany" type="text" aria-describedby="emailHelp" placeholder="Product Company">

                </div>
             </div>
              <div class="col-md-4"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Product Model</label>
                    <input class="form-control" id="pmodel" value="{{$value->pmodel}}" name="pmodel" type="text" aria-describedby="emailHelp" placeholder="Product Model">

                </div>
             </div>
          
              <div class="col-md-4"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Product Serial Number</label>
                    <input class="form-control" id="pserial" name="pserial" value="{{$value->pserial}}" type="text" aria-describedby="emailHelp" placeholder="Product Serial Number" required="">
                </div>
             </div>

              <div class="col-md-4"> 
                <div class="form-group">
                    <label for="exampleInputEmail1">Condition/Remarks</label>
                    <input class="form-control" id="pcondition" value="{{$value->pcondition}}" name="pcondition" type="text" aria-describedby="emailHelp" placeholder="Condition/Remarks" required="">
                </div>
             </div>
             <div class="col-md-4"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Purchase Date</label>
                    <input class="form-control demoDate" id="pdate" value="{{$value->pdate}}" name="pdate" type="text" aria-describedby="emailHelp" placeholder="Purchase Date" required="">
                </div>
             </div>
            
             <div class="col-md-4"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Description</label>
                    <textarea class="form-control" rows="3" placeholder="Product Brief Description" name="pdescription"  id="pdescription" required="">{{$value->pdescription}}</textarea>
                </div>
             </div>
              <div class="col-md-4"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Upload Invoice</label>
                    <input class="form-control" value="{{$value->pinvoice}}" id="pinvoice" name="pinvoice" type="file" aria-describedby="emailHelp" placeholder="Upload Invoice" required="">
                </div>
             </div>
             @if($value->pinvoice!=null)
            <a href="{{url('storage/product/'.$value->pinvoice)}}" target="_blank"> <img src="{{url('storage/product/'.$value->pinvoice)}}" height="100px" width="100px"></a>
             @endif
          </div>
          @endforeach
          </li>
        </ul>
       
    <div class="tile-footer">
              <button class="btn btn-success fa fa-save" type="submit">  Submit</button>
           
            </div>
            </form> 
        </div>
      </div>

    </main>

   


    <!-- Essential javascripts for application to work-->
    {!!View('partials.include_js')!!}

  </body>

<!-- Mirrored from pratikborsadiya.in/vali-admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Jul 2018 06:07:27 GMT -->
</html>

