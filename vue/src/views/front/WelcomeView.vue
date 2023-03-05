<template>
    <main class="container marginTop">
        <section>
            <div class="row">
                <div class="col-md-6">
                    <h2>
                        The most fastest and responsiable Stock Management System
                    </h2>
                    <p>
                        <b>need slogan</b>
                    </p>
                    <p>

                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus neque aliquam quia libero
                        minima, maiores exercitationem, autem accusantium cum sunt maxime voluptate harum quidem nihil
                        illo, debitis laboriosam molestias expedita.
                    </p>

                    <router-link v-if="!token" :to="{name:'login'}" class="btn btn-outline-danger mb-5">
                        login to system
                    </router-link>
                </div>
                <div class="d-none d-sm-none d-md-block col-md-6 mb-5 ">
                    <img src="../../assets/img/demo.png" alt="" class="wfull">
                </div>
            </div>
        </section>

    </main>
    <section class="bg-white p-4">
        <main class="container ">

            <div class="row">
                <div class="col-md-4">
                    <div class="card ">
                        <div class="card-header m-3 p-0">
                            <p>
                                <b>why to use this system</b>
                            </p>
                        </div>
                        <div class="card-body">
                            <p>this system help to anylize business dission.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card ">
                        <div class="card-header m-3 p-0">
                            <p>
                                <b>stock assistan</b>
                            </p>
                        </div>
                        <div class="card-body">
                            <p> track your stock via the system </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card ">
                        <div class="card-header m-3 p-0">
                            <p>
                                <b>finance assistan</b>
                            </p>
                        </div>
                        <div class="card-body">
                            <p> this system is number one assitan of finance </p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </section>
    <section class="bgProof">
        <main class="container p-2">
            <div class="bg-white  shadow  rounded ">
                <section class="m-4">
                    <h1>
                        More about the system.
                    </h1>
                    <p>
                        this version is the first version.
                    </p>
                    <p>
                        this system needs more features and functionality, like corn job for dedecting expired goods at stock.
                    </p>
                    <p>
                        print function like integrate vue js vrpint package or adding some other way of printing.
                    </p>
                    <p>
                        database backup like integrate spatie laravel backup and export data to csv file.
                    </p>

                    <p>
                        but to see and test current functionality please login to system and see the features.
                    </p>

                   <h5>
                    note.
                   </h5>
                   <p>
                        In second version i will enable those functionality and fix the writing spell too.
                   </p>
                   <br>
                </section>
            </div>
        </main>
    </section>
    <section class="bg-white my-3 ">
        <main class="container  p-2 d-flex flex-row ">
            <div>

                <img src="../../assets/img/me.jpg" class="aboutMeImage " alt="">
            </div>
            <div class="mx-5">
                <h2>
                    about me
                </h2>
               <h5>
                I am Mohammad Ali Qurban, A <b>full stack web developer</b> form Kabul Afghanistan.
               </h5>
                <p>I love to use PHP and PHP Laravel framework for backend development</p>
                <p>And Vue JS for FrontEnd development</p>
            </div>
        </main>
        </section>
</template>
<script setup>
import { useLoginStore } from '../../stores/login';

const {token}=useLoginStore()

</script>
