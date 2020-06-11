import { Component, OnInit } from '@angular/core';
import { Tema } from '../../entities/tema';
import { ApiService } from '../api.service';
import { HttpClient } from '@angular/common/http';

@Component({
  selector: 'app-tema',
  templateUrl: './tema.component.html',
  styleUrls: ['./tema.component.css']
})
export class TemaComponent implements OnInit {
  p: number = 1;
  temas: Tema[];
  temaSeleccionado: Tema ={idTema: null, nombre: null, archivoTema: null, duracion: null, imagen: null, nombreArtista: null, valoracion: null}
  constructor(private apiService: ApiService, private httpx: HttpClient) { }
  onSelectFile(event){
    const fd = new FormData();
    fd.append('image', event.target.files[0], event.target.files[0].name);
    this.httpx.post('...', fd).subscribe(
      res => { 
        console.log("event.target.files[0]") 
      });
  }
  createOrUpdateTema(form){
    if(this.temaSeleccionado && this.temaSeleccionado.idTema){
      form.value.idTema = this.temaSeleccionado.idTema;
      console.log(form.value.idTema);
      this.apiService.updateTema(form.value).subscribe((tema: Tema)=>{
        console.log("Tema actualizado" , tema);
        this.ngOnInit();
      });
    }
    else{

      this.apiService.createTema(form.value).subscribe((tema: Tema)=>{
        console.log("Tema created, ", tema);
        this.ngOnInit();
      });
    }
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
    this.apiService.readTemas().subscribe((temas: Tema[])=>{
      this.temas = temas;
      console.log(this.temas)
    });
  }

}
