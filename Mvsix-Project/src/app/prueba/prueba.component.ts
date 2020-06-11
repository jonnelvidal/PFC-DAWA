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
  createOrUpdateUsuario(form){
    if(this.usuarioSeleccionado && this.usuarioSeleccionado.idUsuario){
      form.value.idUsuario = this.usuarioSeleccionado.idUsuario;
      console.log(form.value.idUsuario);
      this.apiService.updateUsuario(form.value).subscribe((usuario: Usuario)=>{
        console.log("Usuario actualizado" , usuario);
        this.ngOnInit();
      });
    }
    else{

      this.apiService.createUsuario(form.value).subscribe((usuario: Usuario)=>{
        console.log("Usuario created, ", usuario);
        this.ngOnInit();
      });
    }
  }

  seleccionarUsuario(usuario: Usuario){
    this.usuarioSeleccionado = usuario;
    return this.usuarioSeleccionado;
  }

  deleteUsuario(usuario: Usuario){
    this.apiService.deleteUsuario(usuario).subscribe((usuario: Usuario)=>{
      console.log("Usuario deleted, ", usuario);
      this.ngOnInit();
    });
    
  }
  ngOnInit() {
    this.apiService.readUsuarios().subscribe((usuarios: Usuario[])=>{
      this.usuarios = usuarios;
    });
    

  }

}
