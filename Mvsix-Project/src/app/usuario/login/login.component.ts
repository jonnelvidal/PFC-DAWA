import { Component, OnInit, ViewEncapsulation, Injectable } from '@angular/core';
import { MatDialog, MatDialogRef } from '@angular/material/dialog';
import { Usuario } from 'src/entities/usuario';
import { ApiService } from 'src/app/api.service';
import { CookieService } from 'ngx-cookie-service';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';

@Component({
  selector: 'app-login',
  styleUrls: ['./login.component.css'],
  templateUrl: './login.component.html',
  encapsulation: ViewEncapsulation.None //Necesario para estilizar los componentes hijos
})

@Injectable()
export class LoginComponent implements OnInit {

  usuarioLogeado: Usuario = { idUsuario: null, usuario: null, contrasena: null, email: null, nombre: null, apellido1: null, apellido2: null, fec_nac: null, pais: null, telefono: null, rol: null, fotoUsuario: null }
  datosUsuarioForm: FormGroup;
  errorhttp: Boolean = false;
  mensajeError: string;
  constructor(
    private dialog: MatDialog,
    private apiService: ApiService,
    private _formBuilder: FormBuilder
    ) { }

  openDialog(): void {
    const dialogRef = this.dialog.open(DialogLogin, {
      width: '50%',
      height: 'auto',

    });
    
    dialogRef.afterClosed().subscribe(result => {
      console.log('The dialog was closed');
    });
  }
  
  establecerDatos() {
    if (this.datosUsuarioForm.invalid) {
      return false;
    } else {
      this.usuarioLogeado.usuario = this.datosUsuarioForm.value.usuario;
      this.usuarioLogeado.contrasena = this.datosUsuarioForm.value.contrasena;
      return true;
    }

  }
  get datosUsuario() { return this.datosUsuarioForm.controls; }
  iniciarSesion() {
    this.establecerDatos();
    this.apiService.loginUsuario(this.usuarioLogeado).subscribe((usuario: Usuario) => {
      this.usuarioLogeado = usuario;
      console.log(usuario);
    });
  }
  ngOnInit(): void {
    this.openDialog();
    this.datosUsuarioForm = this._formBuilder.group({
      usuario: ['', Validators.required],
      contrasena: ['', Validators.required]
    });
  }
}

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class DialogLogin implements OnInit {
  usuarioLogeado: Usuario = { idUsuario: null, usuario: null, contrasena: null, email: null, nombre: null, apellido1: null, apellido2: null, fec_nac: null, pais: null, telefono: null, rol: null, fotoUsuario: null }
  datosUsuarioForm: FormGroup;
  errorhttp: Boolean = false;
  mensajeError: string;
  constructor(
    public dialogRef: MatDialogRef<DialogLogin>, private apiService: ApiService, public dialog: MatDialog, private _formBuilder: FormBuilder
  ) { }

  registrar() {
    this.dialogRef.close();
  }
  onNoClick(): void {
    this.dialogRef.close();
  }
  establecerDatos() {
    if (this.datosUsuarioForm.invalid) {
      return false;
    } else {
      this.usuarioLogeado.usuario = this.datosUsuarioForm.value.usuario;
      console.log(this.datosUsuarioForm.value.usuario)
      this.usuarioLogeado.contrasena = this.datosUsuarioForm.value.contrasena;
      return true;
    }
  }
  get datosUsuario() { return this.datosUsuarioForm.controls; }
  iniciarSesion() {
    this.establecerDatos();
    console.log(this.usuarioLogeado);
    this.apiService.loginUsuario(this.usuarioLogeado).subscribe(result => {
      console.log(result);
    }, error => {
      console.log(error.status);
      this.errorhttp = error.status;
      if(error.status == 400){
        this.mensajeError = "El usuario o la contraseña son incorrectos.";
        this.errorhttp = true;
        return this.errorhttp;
      }
    });
  }
  ngOnInit(): void {
    this.datosUsuarioForm = this._formBuilder.group({
      usuario: ['', Validators.required],
      contrasena: ['', Validators.required]
    });
  }
}