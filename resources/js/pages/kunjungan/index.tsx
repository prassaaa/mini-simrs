import KunjunganController from '@/actions/App/Http/Controllers/KunjunganController';
import Heading from '@/components/heading';
import { Button } from '@/components/ui/button';
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/components/ui/table';
import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem, type Kunjungan, type PaginatedData } from '@/types';
import { Head, Link, router } from '@inertiajs/react';
import { format } from 'date-fns';
import { Eye, Pencil, Plus, Trash2 } from 'lucide-react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Data Kunjungan',
        href: KunjunganController.index().url,
    },
];

interface Props {
    kunjungans: PaginatedData<Kunjungan>;
}

export default function Index({ kunjungans }: Props) {
    const handleDelete = (id: number) => {
        if (confirm('Apakah Anda yakin ingin menghapus data kunjungan ini?')) {
            router.delete(KunjunganController.destroy(id).url);
        }
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Data Kunjungan" />
            
            <div className="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
                <div className="flex items-center justify-between">
                    <Heading title="Data Kunjungan" />
                    <Link href={KunjunganController.create().url}>
                        <Button>
                            <Plus className="mr-2 h-4 w-4" />
                            Tambah Kunjungan
                        </Button>
                    </Link>
                </div>

                <div className="rounded-xl border border-sidebar-border/70 bg-card dark:border-sidebar-border">
                    <Table>
                        <TableHeader>
                            <TableRow>
                                <TableHead>No</TableHead>
                                <TableHead>No. Registrasi</TableHead>
                                <TableHead>Pasien</TableHead>
                                <TableHead>Tanggal</TableHead>
                                <TableHead>Dokter</TableHead>
                                <TableHead>Poli</TableHead>
                                <TableHead>Instalasi</TableHead>
                                <TableHead>Penjamin</TableHead>
                                <TableHead className="text-right">Aksi</TableHead>
                            </TableRow>
                        </TableHeader>
                        <TableBody>
                            {kunjungans.data.length === 0 ? (
                                <TableRow>
                                    <TableCell colSpan={9} className="text-center">
                                        Tidak ada data kunjungan
                                    </TableCell>
                                </TableRow>
                            ) : (
                                kunjungans.data.map((kunjungan, index) => (
                                    <TableRow key={kunjungan.id}>
                                        <TableCell>{kunjungans.from + index}</TableCell>
                                        <TableCell className="font-mono text-xs">
                                            {kunjungan.no_registrasi_kunjungan}
                                        </TableCell>
                                        <TableCell>
                                            <div>
                                                <div className="font-medium">
                                                    {kunjungan.pasien?.nama_pasien}
                                                </div>
                                                <div className="text-xs text-muted-foreground">
                                                    {kunjungan.no_rm}
                                                </div>
                                            </div>
                                        </TableCell>
                                        <TableCell>
                                            {format(new Date(kunjungan.tanggal_kunjungan), 'dd/MM/yyyy')}
                                        </TableCell>
                                        <TableCell>{kunjungan.dokter?.nama_dokter}</TableCell>
                                        <TableCell>{kunjungan.poli_relation?.nama_poli}</TableCell>
                                        <TableCell>{kunjungan.instalasi}</TableCell>
                                        <TableCell>{kunjungan.penjamin?.nama_penjamin}</TableCell>
                                        <TableCell className="text-right">
                                            <div className="flex justify-end gap-2">
                                                <Link href={KunjunganController.show(kunjungan.id).url}>
                                                    <Button variant="outline" size="sm">
                                                        <Eye className="h-4 w-4" />
                                                    </Button>
                                                </Link>
                                                <Link href={KunjunganController.edit(kunjungan.id).url}>
                                                    <Button variant="outline" size="sm">
                                                        <Pencil className="h-4 w-4" />
                                                    </Button>
                                                </Link>
                                                <Button
                                                    variant="outline"
                                                    size="sm"
                                                    onClick={() => handleDelete(kunjungan.id)}
                                                >
                                                    <Trash2 className="h-4 w-4" />
                                                </Button>
                                            </div>
                                        </TableCell>
                                    </TableRow>
                                ))
                            )}
                        </TableBody>
                    </Table>
                </div>

                {/* Pagination */}
                {kunjungans.last_page > 1 && (
                    <div className="flex items-center justify-between">
                        <div className="text-sm text-muted-foreground">
                            Menampilkan {kunjungans.from} - {kunjungans.to} dari {kunjungans.total} data
                        </div>
                        <div className="flex gap-2">
                            {kunjungans.links.map((link, index) => (
                                <Link
                                    key={index}
                                    href={link.url || '#'}
                                    preserveScroll
                                    className={`rounded px-3 py-1 text-sm ${
                                        link.active
                                            ? 'bg-primary text-primary-foreground'
                                            : 'bg-muted hover:bg-muted/80'
                                    } ${!link.url ? 'pointer-events-none opacity-50' : ''}`}
                                    dangerouslySetInnerHTML={{ __html: link.label }}
                                />
                            ))}
                        </div>
                    </div>
                )}
            </div>
        </AppLayout>
    );
}

