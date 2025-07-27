<!--sidebar wrapper -->
		<div class="sidebar-wrapper" data-simplebar="true">
			<div class="sidebar-header">
				<div>
					<img src="{{asset('backend/assets/images/logo-e.png')}}" class="logo-icon" alt="logo e" width="250" height="50">
				</div>
				<div>
					<h4 class="logo-text">E-commerce</h4>
				</div>
				<div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
					
				</div>
			</div>
			<!--navigation-->
			<ul class="metismenu" id="menu">
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class='bx bx-home-circle'></i>
						</div>
						<div class="menu-title">Dashboard</div>
						 <li>
                           <a href="{{ route('backend.categories.index') }}" class="btn btn-primary" style="color: #fff;">Categories</a>
                         </li>
						 <li>
                           <a href="{{ route('backend.subcategories.index') }}" class="btn btn-primary" style="color: #fff;">Subcategories</a>
                         </li>
						 <li>
						   <a href="{{ route('backend.products.index') }}" class="btn btn-primary"  style="color: #fff;">Products</a>
						 </li>


					</a>
					<ul>
						<li> 
						</li>
					</ul>
				</li>
				
				
			</ul>
			<!--end navigation-->
		</div>
		<!--end sidebar wrapper -->