<nav class="d-flex flex-column p-3 bg-light vh-100">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
        <span class="fs-4">Dashboard</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link active">
                <i class="bi bi-house-door"></i>
                Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('projects.index') }}" class="nav-link">
                <i class="bi bi-box-seam"></i>
                Products
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('customers.index') }}" class="nav-link">
                <i class="bi bi-people"></i>
                Customers
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="bi bi-currency-dollar"></i>
                Income
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="bi bi-megaphone"></i>
                Promote
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="bi bi-question-circle"></i>
                Help
            </a>
        </li>
    </ul>
</nav>
