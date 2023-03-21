<template>
  <div class="app-wrapper">
    <Transition name="fade" mode="out-in">
      <Component :is="layout">
        <RouterView />
      </Component>
    </Transition>
  </div>
</template>

<script setup lang="ts">
import { useRoute } from "vue-router";
import { computed } from "vue";
import ClearLayout from "@components/layout/ClearLayout.vue";

const route = useRoute();

const layout = computed(() => {
  return route.meta.layout ?? ClearLayout;
});
</script>
