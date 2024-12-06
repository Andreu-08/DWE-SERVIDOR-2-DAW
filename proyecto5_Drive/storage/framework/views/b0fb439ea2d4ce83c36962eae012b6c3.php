<?php $__env->startSection('content'); ?>

<section class="section">
    <form method="POST" action="/login" class="box">
        <?php echo csrf_field(); ?>
        <h1 class="title has-text-centered">Login</h1>
    
        <section class="section">
            <label class="label">Email</label>
            <input class="input" type="email" name="email" placeholder="Email">
        </section>

        <section class="section">
            <label class="label">Password</label>
            <input class="input" type="password" name="password" placeholder="Password">
        </section>

        <section class="section">
            <input class="button is-primary is-fullwidth" type="submit" value="Login">
        </section>

        <section class="section has-text-centered">
            <p>¿No tienes cuenta? <a href="/register">Regístrate aquí</a></p>
        </section>
    </form>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/login.blade.php ENDPATH**/ ?>