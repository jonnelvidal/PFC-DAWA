import { Component, OnInit, ViewEncapsulation } from '@angular/core';
import { ApiService } from 'src/app/api.service';
import { Usuario } from 'src/entities/usuario';
import { MatDialogRef, MatDialog } from '@angular/material/dialog';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';

@Component({
  selector: 'app-registro',
  templateUrl: './registro.component.html',
  styleUrls: ['./registro.component.css'],
  encapsulation: ViewEncapsulation.None //Necesario para estilizar los componentes hijos
})
export class RegistroComponent implements OnInit {
  usuarioRegistro: Usuario = { idUsuario: null, usuario: null, contrasena: null, email: null, nombre: null, apellido1: null, apellido2: null, fec_nac: null, pais: null, telefono: null, rol: null, fotoUsuario: null }
  datosUsuarioForm: FormGroup;
  datosPersonalesForm: FormGroup;
  errorhttp: Boolean = false;
  mensajeError: string;
  constructor(private apiService: ApiService, private dialog: MatDialog, private _formBuilder: FormBuilder) {

  }
  openDialog(): void {
    const dialogRef = this.dialog.open(DialogRegistro, {
      width: '50%',
      height: 'auto',
    });

    dialogRef.afterClosed().subscribe(result => {
      console.log('The dialog was closed');
    });
  }
  ngOnInit(): void {
    this.openDialog();
    this.datosUsuarioForm = this._formBuilder.group({
      usuario: ['', Validators.required],
      contrasena: ['', Validators.required],
      email: ['', Validators.required]
    });
    this.datosPersonalesForm = this._formBuilder.group({
      nombre: ['', Validators.required],
      apellido1: ['', Validators.required],
      apellido2: ['', Validators.required],
      fec_nac: ['', Validators.required],
      pais: ['', Validators.required],
      telefono: ['', Validators.required]
    });
  }
  get datosUsuario() { return this.datosUsuarioForm.controls; }
  get datosPersonales() { return this.datosPersonalesForm.controls; }
  establecerDatos() {
    if (this.datosUsuarioForm.invalid) {
      return false;
    } else if (this.datosPersonalesForm.invalid) {
      return false;
    } else {
      this.usuarioRegistro.usuario = this.datosUsuarioForm.value.usuario;
      this.usuarioRegistro.contrasena = this.datosUsuarioForm.value.contrasena;
      this.usuarioRegistro.email = this.datosUsuarioForm.value.email;
      this.usuarioRegistro.nombre = this.datosPersonalesForm.value.nombre;
      this.usuarioRegistro.apellido1 = this.datosPersonalesForm.value.apellido1;
      this.usuarioRegistro.apellido2 = this.datosPersonalesForm.value.apellido2;
      this.usuarioRegistro.fec_nac = this.datosPersonalesForm.value.fec_nac;
      this.usuarioRegistro.pais = this.datosPersonalesForm.value.pais;
      this.usuarioRegistro.telefono = this.datosPersonalesForm.value.telefono;
      return true;
    }
  }
  registrarUsuario() {
    if (this.establecerDatos()) {
      this.apiService.createUsuario(this.usuarioRegistro).subscribe(result => {
        console.log(result);
      }, error => {
        console.log(error.status);
      });
    } else {
      return;
    }

  }

}
@Component({
  selector: 'app-registro',
  templateUrl: './registro.component.html',
  styleUrls: ['./registro.component.css']
})
export class DialogRegistro implements OnInit {
  usuarioRegistro: Usuario = { idUsuario: null, usuario: null, contrasena: null, email: null, nombre: null, apellido1: null, apellido2: null, fec_nac: null, pais: null, telefono: null, rol: null, fotoUsuario: null }
  informacion: string = "La longitud de caracteres debe estar entre 3 y 45";
  datosUsuarioForm: FormGroup;
  datosPersonalesForm: FormGroup;
  errorhttp: Boolean = false;
  mensajeError: string;
  constructor(
    public dialogRef: MatDialogRef<DialogRegistro>, private apiService: ApiService, public dialog: MatDialog, private _formBuilder: FormBuilder
  ) { }

  onNoClick(): void {
    this.dialogRef.close();
  }

  ngOnInit(): void {
    this.datosUsuarioForm = this._formBuilder.group({
      usuario: ['', Validators.compose([Validators.required, Validators.minLength(3), Validators.maxLength(45)])],
      contrasena: ['', Validators.compose([Validators.required, Validators.minLength(8), Validators.maxLength(45)])],
      email: ['', Validators.required]
    });
    this.datosPersonalesForm = this._formBuilder.group({
      nombre: ['', Validators.required],
      apellido1: ['', Validators.required],
      apellido2: ['', Validators.required],
      fec_nac: ['', Validators.required],
      pais: ['', Validators.required],
      telefono: ['', Validators.required]
    });
  }
  get datosUsuario() { return this.datosUsuarioForm.controls; }
  get datosPersonales() { return this.datosPersonalesForm.controls; }
  establecerDatos() {
    if (this.datosUsuarioForm.invalid) {
      return false;
    } else if (this.datosPersonalesForm.invalid) {
      return false;
    } else {
      this.usuarioRegistro.usuario = this.datosUsuarioForm.value.usuario;
      this.usuarioRegistro.contrasena = this.datosUsuarioForm.value.contrasena;
      this.usuarioRegistro.email = this.datosUsuarioForm.value.email;
      this.usuarioRegistro.nombre = this.datosPersonalesForm.value.nombre;
      this.usuarioRegistro.apellido1 = this.datosPersonalesForm.value.apellido1;
      this.usuarioRegistro.apellido2 = this.datosPersonalesForm.value.apellido2;
      this.usuarioRegistro.fec_nac = this.datosPersonalesForm.value.fec_nac;
      this.usuarioRegistro.pais = this.datosPersonalesForm.value.pais;
      this.usuarioRegistro.telefono = this.datosPersonalesForm.value.telefono;
      return true;
    }

  }
  registrarUsuario() {
    if (this.establecerDatos()) {
      this.apiService.createUsuario(this.usuarioRegistro).subscribe(result => {
        console.log(result);
      }, error => {
        console.log(error.status);
        this.errorhttp = error.status;
        if(error.status == 409){
          this.mensajeError = "El usuario o el email introducido ya existe, por favor introduzca otro.\n Si ya está registrado, puede iniciar sesión.";
          this.errorhttp = true;
          return this.errorhttp;
        }
      });
    } else {
      return;
    }
  }
}