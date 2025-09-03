<?php
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/functions.php';
include __DIR__ . '/includes/header.php';
?>


<div class="hero text-center p-5 bg-gradient rounded-4 shadow-sm">
<h1 class="display-4 fw-bold text-dark">HealthCentral — centralized patient management</h1>
<p class="lead text-secondary">Book appointments, track your token in the queue, upload medical documents, and request ambulance help quickly.</p>
<a href="<?= BASE_URL ?>/auth/register.php" class="btn btn-lg btn-primary"><i class="bi bi-person-plus"></i>Get Started</a>
</div>
<div class="col-md-5 d-none d-md-block">
<img src="<?= BASE_URL ?>/assets/images/hero.jpg" class="img-fluid rounded" alt="hero">
</div>
</div>
</div>
</div>


<div class="row">
<div class="col-md-4">
<div class="card p-3 mb-3">
<h5>Appointments</h5>
<p>Book and manage your appointments with ease.</p>
</div>
</div>
<div class="col-md-4">
<div class="card p-3 mb-3">
<h5>Ambulance</h5>
<p>Call ambulance instantly (configured by admin).</p>
</div>
</div>
<div class="col-md-4">
<div class="card p-3 mb-3">
<h5>Medical Records</h5>
<p>Upload past medical records and medication history.</p>
</div>
</div>
</div>


<?php include __DIR__ . '/includes/footer.php'; ?>