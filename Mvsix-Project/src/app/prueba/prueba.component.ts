import { Component, OnInit } from '@angular/core';
import { ApiService } from '../api.service';
import { Usuario } from '../usuario';

@Component({
  selector: 'app-prueba',
  templateUrl: './prueba.component.html',
  styleUrls: ['./prueba.component.css']
})
export class PruebaComponent implements OnInit {
  usuarios: Usuario[];
 // usuarioSeleccionado: Usuario = {idUsuario: null, usuario: null, contrasena: null, nombre: null, apellido1:null}
  
  constructor(private apiService: ApiService) { }

  ngOnInit() {
    this.apiService.readUsuarios().subscribe((usuarios: Usuario[])=>{
      this.usuarios = usuarios;
      console.log(this.usuarios);
    })
  }

}
