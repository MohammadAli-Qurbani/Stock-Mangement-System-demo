<template>
  <main class="main" id="main">
    <section class="section"  v-if="Object.keys(stockStore.stock).length">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h3 class="float-left">drag information in stock</h3>


              <!-- Default Table -->
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">drag name</th>
                    <th scope="col">quantity</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th>{{ stockStore.stock.stock.id }}</th>
                    <th>{{ stockStore.stock.stock.drag_name }}</th>
                    <th>{{ stockStore.stock.stock.quantity }}</th>
                  </tr>
                </tbody>
              </table>
              <!-- End Default Table Example -->
            </div>
          </div>
        </div>

        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h3 class="float-left">company info</h3>

              <!-- Default Table -->
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">company</th>
                    <th scope="col">phone</th>
                    <th scope="col">email</th>
                    <th scope="col">city</th>
                    <th scope="col">district</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(item,index) in stockStore.stock.info" :key="index">
                    <td>{{ ++index }}</td>
                    <td>{{ item.company }}</td>
                    <td>{{ item.phone }}</td>
                    <td>{{ item.email }}</td>
                    <td>{{ item.city }}</td>
                    <td>{{ item.district }}</td>
                  </tr>
                </tbody>
              </table>
              <!-- End Default Table Example -->
            </div>
          </div>
        </div>
        <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="float-left">drag in stock rate</h3>

                            <!-- Default Table -->
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">drag name</th>
                                        <th scope="col">company</th>
                                        <th scope="col">unit price</th>
                                        <th scope="col">made date</th>
                                        <th scope="col">expire date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <tr v-for="rateInfo in stockStore.stock.stock.drag_rateCompanies">
                                            <td>{{ stockStore.stock.stock.drag_name}}</td>
                                            <td>{{ rateInfo.good.supplier.company_name }}</td>
                                            <td>{{ rateInfo.rate}}</td>
                                            <td>{{ rateInfo.made_date}}</td>
                                            <td>{{ rateInfo.expired_date}}</td>

                                        </tr>
                                </tbody>
                            </table>
                            <!-- End Default Table Example -->
                        </div>
                    </div>
                </div>
      </div>
    </section>
  </main>
</template>
<script setup>
import { useStockStore } from "../../stores/stock";
const stockStore = useStockStore();
const props = defineProps({ id: { required: true } });
stockStore.show(props.id);

</script>
