import { Component, OnInit, ViewEncapsulation } from '@angular/core';
import { ApiService } from 'src/app/api.service';
import { Usuario } from 'src/entities/usuario';
import { MatDialogRef, MatDialog } from '@angular/material/dialog';

@Component({
  selector: 'app-registro',
  templateUrl: './registro.component.html',
  styleUrls: ['./registro.component.css'],
  encapsulation: ViewEncapsulation.None //Necesario para estilizar los componentes hijos
})
export class RegistroComponent implements OnInit {
  usuarioSeleccionado: Usuario = { idUsuario: null, usuario: null, contrasena: null, email: null, nombre: null, apellido1: null, apellido2: null, fec_nac: null, pais: null, telefono: null, rol: null, fotoUsuario: null }
  constructor(private apiService: ApiService, private dialog: MatDialog, ) { 

  }
  openDialog(): void {
    const dialogRef = this.dialog.open(DialogRegistro, {
      width: '50%',
      height : 'auto',
    });

    dialogRef.afterClosed().subscribe(result => {
      console.log('The dialog was closed');
    });
  }
  ngOnInit(): void {
    this.openDialog();
  }
  
  createOrUpdateUsuario(form){
      this.apiService.createUsuario(form.value).subscribe((usuario: Usuario)=>{
        console.log("Usuario created, ", usuario);
        form.resetForm();
      });
    }
  
}
@Component({
  selector: 'app-registro',
  templateUrl: './registro.component.html',
  styleUrls: ['./registro.component.css']
})
export class DialogRegistro {
  usuarioSeleccionado: Usuario = { idUsuario: null, usuario: null, contrasena: null, email: null, nombre: null, apellido1: null, apellido2: null, fec_nac: null, pais: null, telefono: null, rol: null, fotoUsuario: null }
  constructor(
    public dialogRef: MatDialogRef<DialogRegistro>, private apiService: ApiService, public dialog: MatDialog
  ) { }
  createOrUpdateUsuario(form){
    this.apiService.createUsuario(form.value).subscribe((usuario: Usuario)=>{
      console.log("Usuario created, ", usuario);
      form.resetForm();
    });
  }
  onNoClick(): void {
    this.dialogRef.close();
  }

}