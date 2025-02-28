<template>
    <v-responsive class="border rounded" max-height="300">
      <v-app>
        <v-app-bar class="px-3">
          <v-spacer></v-spacer>

        </v-app-bar>
  
        <v-main>
          <v-container>
            <v-card
                class="mx-auto"
                max-width="450"
                text="Update your weak or re-used passwords with Password Checkup. It's free and only takes a few minutes. Click the Take Checkup button to get started."
                title="Zaloguj się już teraz!"
            >

                <template v-slot:actions>
                <v-btn
                    class="flex-grow-1"
                    height="48"
                    variant="tonal"
                    @click="goToLogin" 
                >
                    Take Checkup
                </v-btn>
                </template>
            </v-card>
          </v-container>
        </v-main>
      </v-app>
    </v-responsive>
  </template>


<script>
export default {
  methods: {
    goToLogin() {
      this.$router.push('/login');  
    },
    onClick() {
      console.log("clicked"); 
    },
  },
};
</script>