export interface ChecklistItem {
	message: string;
	status:
		| 'COMPLETED'
		| 'BLOCKING'
		| 'ERROR'
		| 'INFO'
		| 'ERROR'
		| 'NONBLOCKING';
	action?: () => void;
	name: string;
}
