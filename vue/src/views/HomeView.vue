<template>
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><router-link to="/" >public viwe</router-link></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard" v-if="generalReportData.length">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <!-- Sales Card -->
            <div class="col-md-4 col-md-4 col-sm-6">
              <div class="card info-card sales-card">



                <div class="card-body">
                  <h5 class="card-title"> Total Supplier </h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-cart"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{ generalReportData[0].totalSuppliers }}</h6>
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Revenue Card -->
            <div class="col-md-4 col-md-4 col-sm-6">
              <div class="card info-card revenue-card">

                <div class="card-body">
                  <h5 class="card-title">Total Category</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-currency-dollar"></i>
                    </div>
                    <div class="ps-3">
                        <h6>{{ generalReportData[0].totalCategories }}</h6>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->

            <!-- Customers Card -->
            <div class="col-md-4 col-xl-4 col-sm-6">

              <div class="card info-card customers-card">
                <div class="card-body">
                  <h5 class="card-title">Admin(s) <span>| This Year</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                        <h6>{{ generalReportData[0].totalAdmin }}</h6>
                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Customers Card -->



          </div>
        </div><!-- End Left side columns -->


      </div>
    </section>

  </main><!-- End #main -->

</template>
<script setup>
    import axiosClient from '../../axios'
    import {ref,onMounted} from 'vue'
    const generalReportData=ref([]);
    const fetchGeneralReport=async()=>{
        await axiosClient.get(`/generalReportForDashboard`)
        .then((response)=>{
            generalReportData.value.push(response.data)
            console.log(generalReportData.value);
        })
        .catch((error)=>{
            console.log(error)
        })
    }
    onMounted(async()=>{
        await fetchGeneralReport()
    })
</script>
