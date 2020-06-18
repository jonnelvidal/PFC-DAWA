import { Component, OnInit } from '@angular/core';
import { Tema } from '../../entities/tema';
import { ApiService } from '../api.service';
import { HttpClient } from '@angular/common/http';
import { AuthService } from '../auth.service';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';

@Component({
  selector: 'app-tema',
  templateUrl: './tema.component.html',
  styleUrls: ['./tema.component.css']
})
export class TemaComponent implements OnInit {
  p: number = 1;
  temas: Tema[];
  subirTema: Boolean = false;
  formularioTema: FormGroup;
  temaSeleccionado: Tema ={idTema: null, nombre: null, archivoTema: null, duracion: null, imagen: null, nombreArtista: null, valoracion: null}
  constructor(private apiService: ApiService, private auth: AuthService, private httpx: HttpClient, private _formBuilder: FormBuilder) { }
  onSelectFile(event){
    const fd = new FormData();
    fd.append('image', event.target.files[0], event.target.files[0].name);
    this.httpx.post('...', fd).subscribe(
      res => { 
        console.log("event.target.files[0]") 
      });
  }
  get datosTema() { return this.formularioTema.controls; }
  createOrUpdateTema(form){
    
      this.temaSeleccionado = form.value;
      console.log(this.temaSeleccionado);
      console.log(this.auth.getUsuario());
      this.apiService.createTema(this.temaSeleccionado, this.auth.getUsuario()).subscribe((tema: Tema)=>{
        this.ngOnInit();
      });
  }
  mostrarFormularioTema(){
    this.subirTema = true;
  }
  seleccionarTema(tema: Tema){
    this.temaSeleccionado = tema;
    return this.temaSeleccionado;
  }
  
  deleteTema(tema: Tema){
    this.apiService.deleteTema(tema).subscribe((tema: Tema)=>{
      console.log("Tema deleted, ", tema);
      this.ngOnInit();
    });
    
  }
  ngOnInit() {
    this.formularioTema = this._formBuilder.group({
      nombre: ['', Validators.required],
      archivoTema: ['', Validators.required],
      nombreArtista: ['', Validators.required],
      duracion: ['', Validators.required],
      valoracion: ['', Validators.required],
      imagen: ['', Validators.required]
    });
    this.apiService.readTemasUsuario(this.auth.getUsuario()).subscribe((temas: Tema[])=>{
      this.temas = temas;
      console.log(this.temas)
    });
    
  }

}
