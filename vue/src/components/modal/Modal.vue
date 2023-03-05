<template>
    <div class="modalBg"  @click.self="$emit('closeModal')">
        <div class="modalDailog">
            <div class="modalContent">
                <slot></slot>
                <div class="row">
                    <div class="col-md-8"></div>
                    <div class="col-md-4 ">
                        <button class="float-left btn btn-dark " @click="$emit('closeModal')">close modal</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>
<script setup>
    import { defineEmits } from 'vue';
    defineEmits("closeModal")
</script>
<style>
.modalDailog {
    width: 600px;
    padding: 20px;
    margin: 10px auto;
    background-color: #fff;
    border-radius: 4px;
}

.modalBg {
    top: 0;
    left: 0;
    /* left: 150px; */
    position: fixed;
    background: rgba(0, 0, 0, 0.5);
    width: 100%;
    height: 100%;
    overflow-x: hidden;
    overflow-y: auto;
    z-index: 1055;
    transition: ease-in-out 1s;
}
</style>