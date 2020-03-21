import { Component, OnInit, Inject } from '@angular/core';
import { Usuario } from 'src/entities/usuario';
import { ApiService } from '../api.service';
import {MatDialog, MatDialogRef, MAT_DIALOG_DATA} from '@angular/material/dialog';
import {ViewEncapsulation} from '@angular/core';
@Component({
  selector: 'app-usuario',
  templateUrl: './login.component.html',
  styleUrls: ['./usuario.component.css'],
  encapsulation: ViewEncapsulation.None 
})
export class UsuarioComponent implements OnInit {
  p: number = 1;
  usuarios: Usuario[];
  usuarioSeleccionado: Usuario = {idUsuario: null, usuario: null, contrasena: null, email: null, nombre: null, apellido1:null, apellido2: null, fec_nac: null, pais: null, telefono: null, rol: null, fotoUsuario: null}
  usuarioLogeado: Usuario = {idUsuario: null, usuario: null, contrasena: null, email: null, nombre: null, apellido1:null, apellido2: null, fec_nac: null, pais: null, telefono: null, rol: null, fotoUsuario: null}
  constructor(private apiService: ApiService, public dialog: MatDialog) { }
  loginUsuario(form){
    this.apiService.loginUsuario(form.value).subscribe((usuario: Usuario)=>{
      this.usuarioLogeado = usuario;
      console.log("Usuario logeado, ", this.usuarioLogeado);
      this.ngOnInit();
    });
    
  }
  
  openDialog(): void {
    const dialogRef = this.dialog.open(DialogOverviewExampleDialog, {
      width: '50%',
      height: '75%',
      panelClass: 'my-dialog',
    });

    dialogRef.afterClosed().subscribe(result => {
      console.log('The dialog was closed');
      
    });
  }
  
  ngOnInit() {
    this.openDialog();
  }

}
@Component({
  selector: 'app-login',
  templateUrl: './login-dialog.component.html',
  styleUrls: ['./usuario.component.css']
})
export class DialogOverviewExampleDialog {

  constructor(
    public dialogRef: MatDialogRef<DialogOverviewExampleDialog>,
   ) {}

  onNoClick(): void {
    this.dialogRef.close();
  }

}
