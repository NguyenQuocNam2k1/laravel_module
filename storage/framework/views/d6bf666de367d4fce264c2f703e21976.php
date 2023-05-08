
<?php $__env->startSection('title' , 'Chi tiet nguoi dung'); ?>
<?php $__env->startSection('content'); ?>
    <h1><?php echo e(trans('User::custom.title', ['name' => 'DEMO'])); ?> : <?php echo e($id); ?></h1>  
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.client', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\learn_php\laravel_modules\modules/User/resources/view/detail.blade.php ENDPATH**/ ?>