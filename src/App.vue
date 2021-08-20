<template>
  <v-app>
    <v-app-bar app color="blue">
      <div class="d-flex align-center mr-2">
        Angebote für Abschlussarbeiten
      </div>

      <v-btn to="/thesesview" text>
        Abschlussarbeiten
      </v-btn>

      <v-btn to="/admin" text>
        Login
      </v-btn>
    </v-app-bar>

    <v-main>
      <router-view />
    </v-main>
  </v-app>
</template>

<script>
export default {
  name: "app",
};
</script>