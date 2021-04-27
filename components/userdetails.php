<style>
  #userDetailsModal form {
    width:80%;
    margin-top:20px;
    margin-left: auto;
    margin-right: auto;
  }

  #userDetailsModal .form-group.row {
    margin-top:20px;
    margin-top:20px;
  }

  #userDetailsModal label span.label-description {
    display: inline-block;
    font-size:0.8em;
    font-weight: 100;
  }
</style>

<div class="modal fade" id="userDetailsModal" tabindex="-1" role="dialog" aria-labelledby="userDetailsModal" aria-hidden="true">
    <div class="modal-dialog dark-modal" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title" id="userDetailsModal">Dicci qualcosa su di te</h3>
          </div>
          <div class="modal-body">
            Prima di iniziare il test ci servono delle informazioni su di te:
            <form id="userDetailsForm">
              <div class="form-group row">
                <label for="user_nickname" class="col-form-label">
                  Pseudonimo:<br>
                  <span class="label-description">
                    Scrivi un soprannome che ci aiuterà a distinguere i vari test mantenendo l'anonimato
                  </span>
                </label>
                  <input type="text" class="form-control" id="user_nickname" placeholder="es: juliet-reds" required>
              </div>
              <div class="form-group row">
                <label for="user_gender" class="col-form-label">
                  Sesso:<br>
                  <span class="label-description">
                    Indica il sesso che ti è stato <b>assegnato alla nascita</b>
                  </span>
                </label>
                <select class="form-control" id="user_gender" required>
                  <option value="" selected disabled hidden>seleziona...</option>
                  <option value="female">Femminile</option>
                  <option value="male">Maschile</option>
                  <option value="intersex">Intersessuale</option>
                </select>
              </div>
              <div class="form-group row">
                <label for="user_color" class="col-form-label">
                  Lavori con il colore?<br>
                  <span class="label-description">
                    Per lavoro o per passione hai a che fare quotidianamente con il colore?<br>
                    Ad esempio: fotografo, grafico, pittore...
                  </span>
                </label>
                <select class="form-control" id="user_color" required>
                  <option value="" selected disabled hidden>seleziona...</option>
                  <option value="yes">Sì</option>
                  <option value="no">No</option>
                </select>
              </div>
              <div class="form-group row">
                <label for="user_colorblind" class="col-form-label">
                  Hai problemi a vedere i colori?<br>
                  <span class="label-description">
                    Hai o hai mai avuto problemi con la visione dei colori?
                  </span>
                </label>
                <select class="form-control" id="user_colorblind" required>
                  <option value="" selected disabled hidden>seleziona...</option>
                  <option value="yes">Sì</option>
                  <option value="no">No</option>
                  <option value="unsure">Non so</option>
                </select>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button id="saveUserDetails" type="button" class="btn btn-primary">Salva e prosegui</button>
          </div>
        </div>
    </div>
</div>