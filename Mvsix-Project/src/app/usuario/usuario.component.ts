import { Component, OnInit, Inject } from '@angular/core';
import { Usuario } from 'src/entities/usuario';
import { ApiService } from '../api.service';
import {MatDialog, MatDialogRef, MAT_DIALOG_DATA} from '@angular/material/dialog';
import {ViewEncapsulation} from '@angular/core';
import { LoginComponent } from './login/login.component';
import { Routes } from '@angular/router';
import { PerfilComponent } from './perfil/perfil.component';
import { RegistroComponent } from './registro/registro.component';

const routes: Routes = [
  { path: 'login', loadChildren: () => import('./login/login.module').then(m => m.LoginModule) },
  { path: 'perfil', loadChildren: () => import('./perfil/perfil.module').then( m=> m.PerfilModule) },
  { path: 'registro', loadChildren: () =>import('./registro/registro.module').then( m=> m.RegistroModule) }
  
];
@Component({
  selector: 'app-login',
  templateUrl: './login/login.component.html',
  styleUrls: ['./login/login.component.css'],
  encapsulation: ViewEncapsulation.None 
})
export class UsuarioComponent implements OnInit {
  ngOnInit(): void {
    throw new Error("Method not implemented.");
  }

}
@Component({
  selector: 'app-login',
  templateUrl: './login/login.component.html',
  styleUrls: ['./login/login.component.css']
})
export class DialogOverviewExampleDialog {
  usuarioLogeado: Usuario = {idUsuario: null, usuario: null, contrasena: null, email: null, nombre: null, apellido1:null, apellido2: null, fec_nac: null, pais: null, telefono: null, rol: null, fotoUsuario: null}
  constructor(
    public dialogRef: MatDialogRef<DialogOverviewExampleDialog>, private apiService: ApiService, public dialog: MatDialog
   ) {

   }
   
  
  iniciarSesion(form){
    this.apiService.loginUsuario(form.value).subscribe((usuario: Usuario)=>{
      this.usuarioLogeado = usuario;
      console.log("Usuario logeado, ", this.usuarioLogeado.usuario);
      
    });
  }
  registrar(){
    this.dialogRef.updateSize("100px","100px");
    
  }
  onNoClick(): void {
    this.dialogRef.close();
  }

}
