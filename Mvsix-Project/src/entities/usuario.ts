export class Usuario {
    
    idUsuario: number;
    usuario: string;
    contrasena: string;
    email: string;
    nombre: string;
    apellido1: string;
    apellido2: string;
    fec_nac: string;
    pais: string;
    telefono: number;
    rol: number;
    fotoUsuario: string;

    constructor(usuario: string, contrasena: string){
        this.usuario = usuario;
        this.contrasena = contrasena;
    }

}