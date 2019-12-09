import { Component, OnInit } from '@angular/core';
import { Usuario } from 'src/entities/usuario';
import { ApiService } from '../api.service';
import { analyzeNgModules } from '@angular/compiler';

@Component({
  selector: 'app-usuario',
  templateUrl: './login.component.html',
  styleUrls: ['./usuario.component.css']
})
export class UsuarioComponent implements OnInit {
  p: number = 1;
  usuarios: Usuario[];
  usuarioSeleccionado: Usuario = {idUsuario: null, usuario: null, contrasena: null, email: null, nombre: null, apellido1:null, apellido2: null, fec_nac: null, pais: null, telefono: null, rol: null}
  usuarioLogeado: Usuario = {idUsuario: null, usuario: null, contrasena: null, email: null, nombre: null, apellido1:null, apellido2: null, fec_nac: null, pais: null, telefono: null, rol: null}
  constructor(private apiService: ApiService) { }
  loginUsuario(form){
    this.apiService.loginUsuario(form.value).subscribe((usuario: Usuario)=>{
      this.usuarioLogeado = usuario;
      console.log("Usuario logeado, ", this.usuarioLogeado);
      this.ngOnInit();
    });
    
  }
  
  
  ngOnInit() {
  }

}