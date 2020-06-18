import { Component, OnInit } from '@angular/core';
import { Usuario } from 'src/entities/usuario';
import { ApiService } from 'src/app/api.service';
import { AuthService } from 'src/app/auth.service';
import { Tema } from 'src/entities/tema';

@Component({
  selector: 'app-perfil',
  templateUrl: './perfil.component.html',
  styleUrls: ['./perfil.component.css']
})
export class PerfilComponent implements OnInit {
  amigos: Usuario[];
  temas: Tema[];
  usuarioLogeado: Usuario = { idUsuario: null, usuario: null, contrasena: null, email: null, nombre: null, apellido1: null, apellido2: null, fec_nac: null, pais: null, telefono: null, rol: null, fotoUsuario: null }
  seleccionado: number = 1;
  p: number = 1;
  
  constructor(private apiService: ApiService, private auth: AuthService) { 
  }
  
  ventana(numero){

    if(numero == 1){
      this.seleccionado = 1;
    }else if(numero == 2){
      this.seleccionado = 2;
    }else if(numero == 3){
      this.seleccionado = 3;
    }else{
      this.seleccionado = 4;
    }
  }
  ngOnInit() {
    this.usuarioLogeado = this.auth.getUsuario();
    this.apiService.readAmigos(this.usuarioLogeado).subscribe((usuarios: Usuario[])=>{
      this.amigos = usuarios;
    });
    this.apiService.readTemasUsuario(this.auth.getUsuario()).subscribe((temas: Tema[])=>{
      this.temas = temas;
      console.log(this.temas)
    });
  }
  eliminarAmigo(idUsuario){
    console.log(idUsuario);
  }
}
