import { InertiaLinkProps } from '@inertiajs/react';
import { LucideIcon } from 'lucide-react';

export interface Auth {
    user: User;
}

export interface BreadcrumbItem {
    title: string;
    href: string;
}

export interface NavGroup {
    title: string;
    items: NavItem[];
}

export interface NavItem {
    title: string;
    href: NonNullable<InertiaLinkProps['href']>;
    icon?: LucideIcon | null;
    isActive?: boolean;
}

export interface SharedData {
    name: string;
    quote: { message: string; author: string };
    auth: Auth;
    sidebarOpen: boolean;
    [key: string]: unknown;
}

export interface User {
    id: number;
    name: string;
    email: string;
    avatar?: string;
    email_verified_at: string | null;
    two_factor_enabled?: boolean;
    created_at: string;
    updated_at: string;
    [key: string]: unknown; // This allows for additional properties...
}

export interface Pasien {
    id: number;
    no_rm: string;
    nama_pasien: string;
    tanggal_lahir: string;
    jenis_kelamin: 'L' | 'P';
    alamat: string;
    created_at: string;
    updated_at: string;
}

export interface MasterDokter {
    id: number;
    kode_dokter: string;
    nama_dokter: string;
    spesialisasi: string;
    no_telp?: string;
    created_at: string;
    updated_at: string;
}

export interface MasterPoli {
    id: number;
    kode_poli: string;
    nama_poli: string;
    lokasi?: string;
    created_at: string;
    updated_at: string;
}

export interface MasterPenjamin {
    id: number;
    kode_penjamin: string;
    nama_penjamin: string;
    jenis: 'BPJS' | 'Umum' | 'Asuransi';
    created_at: string;
    updated_at: string;
}

export interface Kunjungan {
    id: number;
    no_registrasi_kunjungan: string;
    no_rm: string;
    tanggal_kunjungan: string;
    kode_dokter: number;
    poli: number;
    instalasi: 'Rawat Jalan' | 'IGD' | 'Rawat Inap';
    penjamin_id: number;
    created_at: string;
    updated_at: string;
    pasien?: Pasien;
    dokter?: MasterDokter;
    poli_relation?: MasterPoli;
    penjamin?: MasterPenjamin;
    transaksi?: Transaksi;
    odontogram?: Odontogram;
}

export type DindingStatus = 'normal' | 'bermasalah' | null;

export interface OdontogramGigi {
    id: number;
    odontogram_id: number;
    nomor_gigi: string;
    kondisi: string;
    dinding_atas: DindingStatus;
    dinding_bawah: DindingStatus;
    dinding_kiri: DindingStatus;
    dinding_kanan: DindingStatus;
    dinding_tengah: DindingStatus;
    keterangan?: string;
    created_at: string;
    updated_at: string;
}

export type OcclusiType = 'normal_bite' | 'cross_bite' | 'steep_bite';
export type TorusPalatinusType = 'tidak_ada' | 'kecil' | 'sedang' | 'besar' | 'multiple';
export type TorusMandibularisType = 'tidak_ada' | 'kiri' | 'kanan' | 'kedua';
export type PalatumType = 'dalam' | 'sedang' | 'rendah';

export interface Odontogram {
    id: number;
    kunjungan_id: number;
    pemeriksaan_ekstra_oral?: string;
    pemeriksaan_intra_oral?: string;
    occlusi: OcclusiType;
    torus_palatinus: TorusPalatinusType;
    torus_mandibularis: TorusMandibularisType;
    palatum: PalatumType;
    diastema: boolean;
    gigi_anomali: boolean;
    status_d: number;
    status_m: number;
    status_f: number;
    hasil_pemeriksaan_penunjang?: string;
    diagnosa?: string;
    planning?: string;
    edukasi?: string;
    created_at: string;
    updated_at: string;
    kunjungan?: Kunjungan;
    gigi_list?: OdontogramGigi[];
}

export interface GigiData {
    kondisi: string;
    dinding_atas?: DindingStatus;
    dinding_bawah?: DindingStatus;
    dinding_kiri?: DindingStatus;
    dinding_kanan?: DindingStatus;
    dinding_tengah?: DindingStatus;
    keterangan?: string;
}

export interface OdontogramFormData {
    pemeriksaan_ekstra_oral?: string;
    pemeriksaan_intra_oral?: string;
    occlusi: OcclusiType;
    torus_palatinus: TorusPalatinusType;
    torus_mandibularis: TorusMandibularisType;
    palatum: PalatumType;
    diastema: boolean;
    gigi_anomali: boolean;
    status_d: number;
    status_m: number;
    status_f: number;
    hasil_pemeriksaan_penunjang?: string;
    diagnosa?: string;
    planning?: string;
    edukasi?: string;
    gigi: Record<string, GigiData>;
}

export interface DetailTransaksi {
    id: number;
    no_transaksi: string;
    nama_tindakan: string;
    harga: string | number;
    qty: number;
    subtotal: string | number;
    created_at: string;
    updated_at: string;
}

export interface Transaksi {
    id: number;
    no_transaksi: string;
    no_registrasi_kunjungan: string;
    total_harga: string | number;
    created_at: string;
    updated_at: string;
    kunjungan?: Kunjungan;
    details?: DetailTransaksi[];
}

export interface PaginatedData<T> {
    data: T[];
    current_page: number;
    first_page_url: string;
    from: number;
    last_page: number;
    last_page_url: string;
    links: Array<{
        url: string | null;
        label: string;
        active: boolean;
    }>;
    next_page_url: string | null;
    path: string;
    per_page: number;
    prev_page_url: string | null;
    to: number;
    total: number;
}

export interface PaginationLinks {
    first: string | null;
    last: string | null;
    prev: string | null;
    next: string | null;
}

export interface PaginationMeta {
    current_page: number;
    from: number;
    last_page: number;
    path: string;
    per_page: number;
    to: number;
    total: number;
}
