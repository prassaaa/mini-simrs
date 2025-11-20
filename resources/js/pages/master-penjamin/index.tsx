import MasterPenjaminController from '@/actions/App/Http/Controllers/MasterPenjaminController';
import Heading from '@/components/heading';
import { Button } from '@/components/ui/button';
import { Badge } from '@/components/ui/badge';
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/components/ui/table';
import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem, type MasterPenjamin, type PaginatedData } from '@/types';
import { Head, Link, router } from '@inertiajs/react';
import { Eye, Pencil, Plus, Trash2 } from 'lucide-react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Master Penjamin',
        href: MasterPenjaminController.index().url,
    },
];

interface Props {
    penjamins: PaginatedData<MasterPenjamin>;
}

export default function Index({ penjamins }: Props) {
    const handleDelete = (id: number) => {
        if (confirm('Apakah Anda yakin ingin menghapus data penjamin ini?')) {
            router.delete(MasterPenjaminController.destroy(id).url);
        }
    };

    const getJenisColor = (jenis: string) => {
        switch (jenis) {
            case 'BPJS':
                return 'bg-green-500/10 text-green-500';
            case 'Umum':
                return 'bg-blue-500/10 text-blue-500';
            case 'Asuransi':
                return 'bg-purple-500/10 text-purple-500';
            default:
                return 'bg-gray-500/10 text-gray-500';
        }
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Master Penjamin" />
            
            <div className="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
                <div className="flex items-center justify-between">
                    <Heading title="Master Penjamin" />
                    <Link href={MasterPenjaminController.create().url}>
                        <Button>
                            <Plus className="mr-2 h-4 w-4" />
                            Tambah Penjamin
                        </Button>
                    </Link>
                </div>

                <div className="rounded-xl border border-sidebar-border/70 bg-card dark:border-sidebar-border">
                    <Table>
                        <TableHeader>
                            <TableRow>
                                <TableHead>No</TableHead>
                                <TableHead>Kode Penjamin</TableHead>
                                <TableHead>Nama Penjamin</TableHead>
                                <TableHead>Jenis</TableHead>
                                <TableHead className="text-right">Aksi</TableHead>
                            </TableRow>
                        </TableHeader>
                        <TableBody>
                            {penjamins.data.length === 0 ? (
                                <TableRow>
                                    <TableCell colSpan={5} className="text-center">
                                        Tidak ada data penjamin
                                    </TableCell>
                                </TableRow>
                            ) : (
                                penjamins.data.map((penjamin, index) => (
                                    <TableRow key={penjamin.id}>
                                        <TableCell>{penjamins.from + index}</TableCell>
                                        <TableCell className="font-mono">{penjamin.kode_penjamin}</TableCell>
                                        <TableCell className="font-medium">{penjamin.nama_penjamin}</TableCell>
                                        <TableCell>
                                            <Badge className={getJenisColor(penjamin.jenis)}>
                                                {penjamin.jenis}
                                            </Badge>
                                        </TableCell>
                                        <TableCell className="text-right">
                                            <div className="flex justify-end gap-2">
                                                <Link href={MasterPenjaminController.show(penjamin.id).url}>
                                                    <Button variant="outline" size="sm">
                                                        <Eye className="h-4 w-4" />
                                                    </Button>
                                                </Link>
                                                <Link href={MasterPenjaminController.edit(penjamin.id).url}>
                                                    <Button variant="outline" size="sm">
                                                        <Pencil className="h-4 w-4" />
                                                    </Button>
                                                </Link>
                                                <Button
                                                    variant="outline"
                                                    size="sm"
                                                    onClick={() => handleDelete(penjamin.id)}
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

                {penjamins.last_page > 1 && (
                    <div className="flex items-center justify-between">
                        <div className="text-sm text-muted-foreground">
                            Menampilkan {penjamins.from} - {penjamins.to} dari {penjamins.total} data
                        </div>
                        <div className="flex gap-2">
                            {penjamins.links.map((link, index) => (
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

