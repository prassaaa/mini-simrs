import MasterDokterController from '@/actions/App/Http/Controllers/MasterDokterController';
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
import { type BreadcrumbItem, type MasterDokter, type PaginatedData } from '@/types';
import { Head, Link, router } from '@inertiajs/react';
import { Eye, Pencil, Plus, Trash2 } from 'lucide-react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Master Dokter',
        href: MasterDokterController.index().url,
    },
];

interface Props {
    dokters: PaginatedData<MasterDokter>;
}

export default function Index({ dokters }: Props) {
    const handleDelete = (id: number) => {
        if (confirm('Apakah Anda yakin ingin menghapus data dokter ini?')) {
            router.delete(MasterDokterController.destroy(id).url);
        }
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Master Dokter" />
            
            <div className="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
                <div className="flex items-center justify-between">
                    <Heading title="Master Dokter" />
                    <Link href={MasterDokterController.create().url}>
                        <Button>
                            <Plus className="mr-2 h-4 w-4" />
                            Tambah Dokter
                        </Button>
                    </Link>
                </div>

                <div className="rounded-xl border border-sidebar-border/70 bg-card dark:border-sidebar-border">
                    <Table>
                        <TableHeader>
                            <TableRow>
                                <TableHead>No</TableHead>
                                <TableHead>Kode Dokter</TableHead>
                                <TableHead>Nama Dokter</TableHead>
                                <TableHead>Spesialisasi</TableHead>
                                <TableHead>No. Telp</TableHead>
                                <TableHead className="text-right">Aksi</TableHead>
                            </TableRow>
                        </TableHeader>
                        <TableBody>
                            {dokters.data.length === 0 ? (
                                <TableRow>
                                    <TableCell colSpan={6} className="text-center">
                                        Tidak ada data dokter
                                    </TableCell>
                                </TableRow>
                            ) : (
                                dokters.data.map((dokter, index) => (
                                    <TableRow key={dokter.id}>
                                        <TableCell>{dokters.from + index}</TableCell>
                                        <TableCell className="font-mono">{dokter.kode_dokter}</TableCell>
                                        <TableCell className="font-medium">{dokter.nama_dokter}</TableCell>
                                        <TableCell>{dokter.spesialisasi}</TableCell>
                                        <TableCell>{dokter.no_telp || '-'}</TableCell>
                                        <TableCell className="text-right">
                                            <div className="flex justify-end gap-2">
                                                <Link href={MasterDokterController.show(dokter.id).url}>
                                                    <Button variant="outline" size="sm">
                                                        <Eye className="h-4 w-4" />
                                                    </Button>
                                                </Link>
                                                <Link href={MasterDokterController.edit(dokter.id).url}>
                                                    <Button variant="outline" size="sm">
                                                        <Pencil className="h-4 w-4" />
                                                    </Button>
                                                </Link>
                                                <Button
                                                    variant="outline"
                                                    size="sm"
                                                    onClick={() => handleDelete(dokter.id)}
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

                {dokters.last_page > 1 && (
                    <div className="flex items-center justify-between">
                        <div className="text-sm text-muted-foreground">
                            Menampilkan {dokters.from} - {dokters.to} dari {dokters.total} data
                        </div>
                        <div className="flex gap-2">
                            {dokters.links.map((link, index) => (
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

