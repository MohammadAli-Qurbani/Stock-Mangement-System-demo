<template>
  <main class="main" id="main">
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <div class="card-header d-flex justify-content-between">
                <h3 >Sold Drags</h3>
                <input v-if="Object.keys(sellStore.sells).length"
                  type="text"
                  class="mt-2 rounded border-0.4"
                  placeholder="search darg name"
                />
              </div>
              <!-- Default Table -->
              <table class="table" v-if="Object.keys(sellStore.sells).length">
                <thead>
                  <tr>
                    <th>id</th>
                    <th>drag name</th>
                    <th>unit price</th>
                    <th>total price</th>
                    <th>quantity</th>
                    <th>date</th>
                    <th>exact date</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="sell in sellStore.sells" :key="sell.id">
                    <td>{{ sell.id }}</td>
                    <td>{{ sell.stock.drag_name }}</td>
                    <td>{{ sell.rate }}</td>
                    <td>{{ sell.total_rate }}</td>
                    <td>{{ sell.quantity }}</td>
                    <td>{{ sell.date }}</td>
                    <td>{{ sell.exact_date }}</td>
                  </tr>
                </tbody>
              </table>
              <h1 v-else>
                <NotFound />
              </h1>
              <!-- End Default Table Example -->
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
</template>

<script setup>
import NotFound from "../../components/pageNotFound/NotFound.vue";
import { useSellStore } from "../../stores/sell";
const sellStore = useSellStore();
sellStore.getSells();
</script>
