<footer class="page-footer">
			<p class="mb-0">Copyright © 2025. All right reserved.</p>
			<p class="mb-0">ZAADE HABEEB</p>

          
               
             <div class="sidebar">
    <ul class="list-unstyled">
        <!-- Other sidebar links -->
        <li class="nav-item">
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </li>
    </ul>
</div>
		</footer>