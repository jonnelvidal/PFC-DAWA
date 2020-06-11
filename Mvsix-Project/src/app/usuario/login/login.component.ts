import { Component, OnInit, ViewEncapsulation, Injectable } from '@angular/core';
import { MatDialog, MatDialogRef } from '@angular/material/dialog';
import { Usuario } from 'src/entities/usuario';
import { ApiService } from 'src/app/api.service';
import { CookieService } from 'ngx-cookie-service';

@Component({
  selector: 'app-login',
  styleUrls: ['./login.component.css'],
  templateUrl: './login.component.html',
  encapsulation: ViewEncapsulation.None //Necesario para estilizar los componentes hijos
})

@Injectable()
export class LoginComponent implements OnInit {
  
  usuarioLogeado: Usuario = { idUsuario: null, usuario: null, contrasena: null, email: null, nombre: null, apellido1: null, apellido2: null, fec_nac: null, pais: null, telefono: null, rol: null, fotoUsuario: null }
  constructor(
    private dialog: MatDialog, 
    private cookie: CookieService
    ) { }

  openDialog(): void {
    const dialogRef = this.dialog.open(DialogLogin, {
      width: '50%',
      height: '50%'
    });

    dialogRef.afterClosed().subscribe(result => {
      console.log('The dialog was closed');
    });
  }
  ngOnInit(): void {
    this.openDialog();
  }
}

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class DialogLogin {
  usuarioLogeado: Usuario = { idUsuario: null, usuario: null, contrasena: null, email: null, nombre: null, apellido1: null, apellido2: null, fec_nac: null, pais: null, telefono: null, rol: null, fotoUsuario: null }
  constructor(
    public dialogRef: MatDialogRef<DialogLogin>, private apiService: ApiService, public dialog: MatDialog
  ) { }
  
  iniciarSesion(form) {
    this.apiService.loginUsuario(form.value).subscribe((usuario: Usuario) => {
      this.usuarioLogeado = usuario

    });
  }
  registrar() {
    this.dialogRef.close();
  }
  onNoClick(): void {
    this.dialogRef.close();
  }

}