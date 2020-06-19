import { Component, OnInit } from '@angular/core';
import { ApiService } from '../api.service';
import { Usuario } from '../../entities/usuario';
import { AuthService } from '../auth.service';
import { isNullOrUndefined } from 'util';
import { LoginComponent } from '../usuario/login/login.component';


@Component({
  selector: 'app-persona',
  templateUrl: './persona.component.html',
  styleUrls: ['./persona.component.css']
})
export class PersonaComponent implements OnInit {
  p: number = 1;
  usuarios: Usuario[];
  usuarioSeleccionado: Usuario = {idUsuario: null, usuario: null, contrasena: null, email: null, nombre: null, apellido1:null, apellido2: null, fec_nac: null, pais: null, telefono: null, rol: null, fotoUsuario: null}
  booleano: Boolean = false;
  usuarioPerfil: Usuario;
  constructor(private apiService: ApiService, private auth: AuthService, private dialogoLogin: LoginComponent) { 

  }
  seleccionarUsuario(usuario: Usuario){
    this.usuarioSeleccionado = usuario;
    return this.usuarioSeleccionado;
  }
  ngOnInit() {
    if(this.auth.getUsuario() == null){
      this.dialogoLogin.openDialog();
    }
    
    this.apiService.readPersonas(this.auth.getUsuario()).subscribe((usuarios: Usuario[])=>{
      this.usuarios = usuarios;
    });
  }
agregarAmigo(idUsuario){
  let idUsuarios = this.auth.getUsuario().idUsuario + ":" +  idUsuario;
  console.log(idUsuarios);
  this.apiService.createAmigo(idUsuarios).subscribe(result => { 
    console.log(result)
  });
}
verPerfil(usuario: Usuario){
  this.usuarioPerfil = usuario;
  return this.usuarioPerfil;
}
}
