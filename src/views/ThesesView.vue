<template>
 <v-card>
   <v-card-title>
      <v-spacer></v-spacer>
      <v-text-field
        v-model="search"
        append-icon="mdi-magnify"
        label="Search"
        single-line
        hide-details
      ></v-text-field>
   </v-card-title>
   <v-data-table
      :headers="thesisHeaders"
      :items="theses"
      :search="search"
      :single-expand="singleExpand"
      :expanded.sync="expanded"
      item-key="titel"
      show-expand
      class="elevation-1"
    >
      <template v-slot:top>
        <v-toolbar flat>
          <v-toolbar-title>Abschlussarbeiten</v-toolbar-title>
          <v-spacer></v-spacer>
          <v-switch
            v-model="singleExpand"
            label="Single expand"
            class="mt-2"
          ></v-switch>
        </v-toolbar>
      </template>
      <template v-slot:expanded-item="{ headers, item }">
        <td :colspan="headers.length">
          More info about {{ item.titel }}
        </td>
      </template>
  </v-data-table>
 </v-card>
 
</template>
<script>
  import axios from "axios";
  export default {
    data () {
      return {
        expanded: [],
        singleExpand: false,
        search: '',
        thesisHeaders: [
          { text: 'ID', align: 'start', sortable: false, value: 'id'},
          { text: 'TITEL', value: 'titel' },
          { text: 'HERAUSGEBER', value: 'publisher' },
          { text: 'JAHR', value: 'year' },
        ],
        theses: [
          {
            /* id: 1,
            titel: 'VueJs',
            publisher: 'HTW',
            year: 1991 */
          },
        ],
      }
    },
    created() {
      this.getTheses();
    },
    methods: {
      getTheses() {
        axios
          .get("http://localhost/php-vue/src/Api/db.php?action=getThesisInfo")
          .then((res) => {
            console.log(res.data.thesis_Data);
            this.theses = res.data.thesis_Data;
          })
          .catch((err) => {
            console.log(err);
          });
      },
    },  

  }
</script>
