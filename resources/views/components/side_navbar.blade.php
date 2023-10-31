
  
  <div class="col-sm-2 px-0" style="height:100vh;">
  
    <nav class ="navbar bg-dark" style="height:95.7vh">
      <ul class ="nav navbar-nav h-100 my-3 " style="font-size:18px;margin-left:25px;">
        <li class="nav-item">
            <a href="{{route('home')}}" class="nav-link" style="color:grey;" onMouseOver="this.style.color='white'"onMouseLeave="this.style.color='grey'">Home</a>
        </li>
        <li class="dropdown">
            <a class="nav-link dropdown-toggle" style="color:grey;" onMouseOver="this.style.color='white'"onMouseLeave="this.style.color='grey'" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Purchase Master</a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{route('purchase_in_entry')}}" class="dropdown-item">Purchase In Entry</a>
                    </li>
                    <li>
                        <a href="{{url('/direct_purchase')}}" class="dropdown-item">Direct Purchase</a>
                    </li>
                    <li>
                        <a href="{{route('purchase_in_list')}}" class="dropdown-item">Purchase In List</a>
                    </li>
                    <li>
                        <a href="{{route('purchase_out_list')}}" class="dropdown-item">Purchase Out List</a>
                    </li>
                    <li>
                        <a href="{{route('pending_purchase_list')}}" class="dropdown-item">Pending List</a>
                    </li>
                </ul>
        </li>
        <li class="dropdown">
            <a class="nav-link dropdown-toggle" style="color:grey;" onMouseOver="this.style.color='white'"onMouseLeave="this.style.color='grey'" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" id="sales_dropdown">Sales Master</a>
            <ul class="dropdown-menu">
                <li>
                    <a href="{{route('sales_in_entry')}}" class="dropdown-item">Sales In Entry</a>
                </li>
                <li>
                    <a href="{{route('direct_sales')}}" class="dropdown-item">Direct Sales</a>
                </li>
                <li>
                    <a href="{{route('sales_in_list')}}" class="dropdown-item">Sales In List</a>
                </li>
                <li>
                    <a href="{{route('sales_out_list')}}" class="dropdown-item">Sales Out List</a>
                </li>
                <li>
                    <a href="{{route('pending_sales_list')}}" class="dropdown-item">Pending List</a>
                </li>
            </ul>
        </li>

        <li class="dropdown">
            <a class="nav-link dropdown-toggle" style="color:grey;" onMouseOver="this.style.color='white'"onMouseLeave="this.style.color='grey'" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Store Master</a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{route('store_status')}}" class="dropdown-item">Store Status</a>
                    </li>
                    <li>
                        <a href="{{route('store_in_list')}}" class="dropdown-item">Store In</a>
                    </li>
                    <li>
                        <a href="{{route('store_out_list')}}" class="dropdown-item">Store Out</a>
                    </li>
                </ul>
        </li>

        <li class="dropdown">
            <a class="nav-link dropdown-toggle" style="color:grey;" onMouseOver="this.style.color='white'"onMouseLeave="this.style.color='grey'" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Fuel Master</a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{route('available_fuel_list')}}" class="dropdown-item">Fuel Available</a>
                    </li>
                    <li>
                        <a href="{{route('fuel_in_list')}}" class="dropdown-item">Fuel In</a>
                    </li>
                    <li>
                        <a href="{{route('fuel_out_list')}}" class="dropdown-item">Fuel Out</a>
                    </li>
                    <li>
                        <a href="{{route('fuel_type_list')}}" class="dropdown-item">Fuel Type Management</a>
                    </li>
                </ul>
        </li>
         
        <li class="nav-item">
            <a href="{{route('item_master')}}"  class="nav-link" style="color:grey;" onMouseOver="this.style.color='white'"onMouseLeave="this.style.color='grey'">Item Master</a>
        </li> 
        <li class="nav-item">
            <a href="{{route('vehicle_master')}}" class="nav-link" style="color:grey;" onMouseOver="this.style.color='white'"onMouseLeave="this.style.color='grey'">Vehicle Master</a>
        </li> 
        <li class="nav-item">
            <a href="{{route('lease_master')}}" class="nav-link" style="color:grey;" onMouseOver="this.style.color='white'"onMouseLeave="this.style.color='grey'">Lease Master</a>
        </li> 
        <li class="nav-item">
            <a href="{{route('user_master')}}" class="nav-link" style="color:grey;" onMouseOver="this.style.color='white'"onMouseLeave="this.style.color='grey'">User Master</a>
        </li>
        <li class="nav-item">
            <a href="{{route('employee_master')}}" class="nav-link" style="color:grey;" onMouseOver="this.style.color='white'"onMouseLeave="this.style.color='grey'">Employee Master</a>
        </li>  
        <li class="nav-item">
            <a href="{{route('contractor_master')}}" class="nav-link" style="color:grey;" onMouseOver="this.style.color='white'"onMouseLeave="this.style.color='grey'">Contractor Master</a>
        </li>  
        <li class="nav-item">
            <a href="{{route('report_master')}}" class="nav-link" style="color:grey;" onMouseOver="this.style.color='white'"onMouseLeave="this.style.color='grey'">Report Master</a>
        </li>
        <li class="nav-item">
            <a href="{{route('mail_master')}}" class="nav-link" style="color:grey;" onMouseOver="this.style.color='white'"onMouseLeave="this.style.color='grey'">Mail Master</a>
        </li>  
      </ul> 
    </nav>
  </div>