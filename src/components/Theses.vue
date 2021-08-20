<template>
  <!-- eslint-disable -->
 <!-- prettier-ignore -->
    <div class="my-4">
       <div class="form-row">
           <div class="form-group col-md-12 col-sm-12">
                <button class="btn btn-success btn-sm float-right" @click="addNew()">Abschlussarbeit hinzufügen</button>
           </div>
       </div>
       <div class="form-row">
           <div class="col-md-12 mt-4">
               <div class="table-responsive">
                <table class="table table-striped table-hover">
                   <thead>
                        <th>ID</th>
                        <th>TITEL</th>
                        <th>HERAUSGEBER</th>
                        <th>JAHR</th>
                        <th>TECHNOLOGIE</th>
                        <th>AKTION</th>
                   </thead>
                   <tbody>
                       <tr v-for="data in Theses">
                           <td>{{data.id}}</td>
                           <td>{{data.titel}}</td>
                           <td>{{data.publisher}}</td>
                           <td>{{data.year}}</td>
                           <td>{{data.proglang}}</td>
                           <!-- <table>{{data.proglang}}</table> -->
                           <td> 
                               <button class="btn btn-danger btn-sm" @click="delThesis(); selectThesis(data);">Löschen</button>
                               <button class="btn btn-info btn-sm"  @click="edThesis(); selectThesis(data);">Ändern</button>
                               <button class="btn btn-success btn-sm">Mehr</button>
                           </td>
                       </tr>
                   </tbody>
               </table>
               </div>
           </div>
       </div>
       <!-- add thesis model -->
       <div class="modal fade" id="AddThesis" tabindex="-1" role="dialog" aria-labelledby="editLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="editLabel">Abschlussarbeit hinzufügen</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="closeWindow()">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="" method="POST">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="titel">Titel</label>
                            <input type="text" titel="titel" class="form-control" id="titel" placeholder="Titel" v-model="newThesis.titel">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="publisher">Herausgeber</label>
                            <input type="text" titel="publisher" class="form-control" id="publisher" placeholder="Herausgeber" v-model="newThesis.publisher" >
                        </div>
                         <div class="form-group col-md-6">
                            <label for="publisher">Jahr</label>
                            <input type="number" titel="year" class="form-control" id="year" placeholder="Jahr" v-model="newThesis.year" >
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="titel">Programmiersprache</label>
                            <select titel="eduction" class="form-control" id="proglang" v-model="newThesis.proglang">
                            <option v-for="prog in Proglang" :value="prog">
                                {{prog}}
                            </option>
                            </select>
                        </div>
                    </div>  
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="closeWindow()">Schließen</button>
                    <button  type="button" class="btn btn-primary" @click="addTheses()">Abschlussarbeit hinzufügen</button>
                </div>
            </form>

          </div>
        </div>
      </div> 
       <!-- ad thesis modal end -->

       <!-- edit thesis model -->
       <div class="modal fade" id="EditThesis" tabindex="-1" role="dialog" aria-labelledby="editLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="editLabel">Abschlussarbeiten aktualisieren</h5>

              <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="closeWindow()">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="" method="POST">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="titel">Titel</label>
                            <input type="text" titel="titel" class="form-control" id="titel" placeholder="Titel" v-model="currentThesis.titel">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="publisher">Herausgeber</label>
                            <input type="text" titel="publisher" class="form-control" id="publisher" placeholder="Herausgeber" v-model="currentThesis.publisher" >
                        </div>
                         <div class="form-group col-md-6">
                            <label for="publisher">Jahr</label>
                            <input type="number" titel="year" class="form-control" id="year" placeholder="Jahr" v-model="currentThesis.year" >
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="titel">Programmiersprache</label>
                            <select titel="eduction" class="form-control" id="proglang" v-model="currentThesis.proglang">
                            <option v-for="prog in Proglang" :value="prog">
                                {{prog}}
                            </option>
                            </select>
                        </div>
                    </div>  
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="closeWindow()">Schließen</button>
                    <button  type="button" class="btn btn-primary" @click="editTheses()">Abschlussarbeit aktualisieren</button>
                </div>
            </form>

          </div>
        </div>
      </div> 
       <!-- edit thesis modal end -->
       <!-- delete thesis model -->
       <div class="modal fade" id="DeleteThesis" tabindex="-1" role="dialog" aria-labelledby="editLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="editLabel">Abschlussarbeit löschen</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="closeWindow()">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body p-3">
               <h4 class="text-danger">Sind Sie sicher ?</h4>
               <h5>Sie löschen '{{currentThesis.titel}}'</h5>
               <hr>
               <button class="btn btn-danger btn-lg" @click="deleteThesis()">Ja</button>
               &nbsp; &nbsp; &nbsp; &nbsp;
               <button class="btn btn-success btn-lg" @click="closeWindow()">nein</button>
              </div>
          </div>
        </div>
      </div> 
       <!-- delete thesis modal end -->             
    </div>
</template>
<script>
import axios from "axios";
export default {
  titel: "Theses",
  data() {
    return {
      modal: null,
      editModal: false,
      addModal: true,
      Proglang: [
        "Java",
        "C#",
        "JavaScript",
        "PHP",
        "Python",
        "Vue",
        "React",
        "Angular",
      ],
      newThesis: {
        titel: null,
        publisher: null,
        year: "",
        proglang: null,
      },
      currentThesis: {},
      Theses: [],
    };
  },
  created() {
    this.getTheses();
  },
  methods: {
    addNew() {
      window.jQuery("#AddThesis").modal("show");
    },
    edThesis() {
      window.jQuery("#EditThesis").modal("show");
    },
    delThesis() {
      window.jQuery("#DeleteThesis").modal("show");
    },
    selectThesis(thesis) {
      this.currentThesis = thesis;
    },
    getTheses() {
      axios
        .get("http://localhost/php-vue/src/Api/db.php?action=getThesisInfo")
        .then((res) => {
          console.log(res.data.thesis_Data);
          this.Theses = res.data.thesis_Data;
        })
        .catch((err) => {
          console.log(err);
        });
    },
    addTheses() {
      let data = new FormData();
      data.append("titel", this.newThesis.titel);
      data.append("publisher", this.newThesis.publisher);
      data.append("year", this.newThesis.year);
      data.append("proglang", this.newThesis.proglang);
      axios
        .post("http://localhost/php-vue/src/Api/db.php?action=addTheses", data)
        .then((res) => {
          if (res.data.error) {
            alert("Error");
          } else {
            window.jQuery("#AddThesis").modal("hide");
            this.getTheses();
            alert(res.data.message);
          }
        })
        .catch((err) => {
          console.log(err);
        });
    },
    editTheses() {
      let data = new FormData();
      data.append("id", this.currentThesis.id);
      data.append("titel", this.currentThesis.titel);
      data.append("publisher", this.currentThesis.publisher);
      data.append("year", this.currentThesis.year);
      data.append("proglang", this.currentThesis.proglang);
      axios
        .post(
          "http://localhost/php-vue/src/Api/db.php?action=updateThesis",
          data
        )
        .then((res) => {
          this.newThesis = {
            titel: null,
            publisher: null,
            year: "",
            proglang: null,
          };
          if (res.data.error) {
            alert("Error");
          } else {
            window.jQuery("#EditThesis").modal("hide");
            this.getTheses();
          }
        })
        .catch((err) => {
          console.log(err);
        });
    },
    deleteThesis() {
      let data = new FormData();
      data.append("id", this.currentThesis.id);
      axios
        .post(
          "http://localhost/php-vue/src/Api/db.php?action=deleteThesis",
          data
        )
        .then((res) => {
          this.newThesis = {
            titel: null,
            publisher: null,
            year: "",
            proglang: null,
          };
          if (res.data.error) {
            alert("Error");
          } else {
            window.jQuery("#DeleteThesis").modal("hide");
            this.getTheses();
          }
        })
        .catch((err) => {
          console.log(err);
        });
    },
    closeWindow() {
      window.jQuery("#AddThesis").modal("hide");
      window.jQuery("#EditThesis").modal("hide");
      window.jQuery("#DeleteThesis").modal("hide");
    },
  },
};
</script>
