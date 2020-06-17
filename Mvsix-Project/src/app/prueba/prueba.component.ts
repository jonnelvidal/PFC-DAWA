import { Component, OnInit } from '@angular/core';
import { ApiService } from '../api.service';
import { Usuario } from '../../entities/usuario';


@Component({
  selector: 'app-prueba',
  templateUrl: './prueba.component.html',
  styleUrls: ['./prueba.component.css']
})
export class PruebaComponent implements OnInit {
  p: number = 1;
  usuarios: Usuario[];
  usuarioSeleccionado: Usuario = {idUsuario: null, usuario: null, contrasena: null, email: null, nombre: null, apellido1:null, apellido2: null, fec_nac: null, pais: null, telefono: null, rol: null, fotoUsuario: null}
  
  constructor(private apiService: ApiService) { 

  }
  seleccionarUsuario(usuario: Usuario){
    this.usuarioSeleccionado = usuario;
    return this.usuarioSeleccionado;
  }
  ngOnInit() {
    this.apiService.readUsuarios().subscribe((usuarios: Usuario[])=>{
      this.usuarios = usuarios;
    });
    

  }

}
