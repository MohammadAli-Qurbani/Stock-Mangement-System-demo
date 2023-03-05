<template>
    <header id="header" class="header fixed-top d-flex align-items-center ">

        <div class="d-flex align-items-center justify-content-between">
            <router-link :to="{name:'welcome'}" class="logo d-flex align-items-center">
                <span class="d-none d-lg-block">Brand Name </span>
            </router-link>
        </div><!-- End Logo -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">


                <li class="nav-item dropdown pe-3">
                    <router-link :to="{name:token?'home':'login'}" class=" nav-profile d-flex align-items-center pe-0">{{ token?'dashboard':'login'  }}</router-link>
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->
</template>

<script setup>
import { useLoginStore } from '../../stores/login';

const {token}=useLoginStore()
</script>
